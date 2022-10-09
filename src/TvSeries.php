<?php

namespace Svit\Exads;

use DateTime;

class TvSeries
{
    public int $id;
    public string $title;
    public int $channel;
    public string $gender;
    public string $week_day;
    public string $show_time;

    private DateTime $initDate;
    private string $date_time;

    public function __construct(DateTime $initDate, $attributes = [])
    {
        $this->initDate = clone $initDate;
        $this->load($attributes);
    }

    public function load(array $attributes)
    {
        foreach ($attributes as $attribute => $value) {
            $this->$attribute = $value;
        }
    }

    public function getDateTime(): string
    {
        if (!isset($this->date_time)) {
            $modifier = "$this->week_day $this->show_time";

            $current = $this->initDate->format('D H:i:s');
            if ($current > $modifier) {
                $modifier = 'next ' . $modifier;
            }

            $this->initDate->modify($modifier);
            $this->date_time = $this->initDate->format('Y-m-d H:i:s');
        }

        return $this->date_time;
    }

    /**
     * @param DateTime $dateTime
     * @param string|null $filter
     * @return self[]
     */
    public static function find(DateTime $dateTime, string $filter = null): array
    {
        $where = $filter ? "title LIKE '%$filter%'" : '1';

        $sql = <<<SQL
SELECT * 
FROM tv_series_intervals tsi
INNER JOIN tv_series ts on tsi.id_tv_series = ts.id
WHERE $where
ORDER BY week_day, show_time
SQL;

        $all = Db::fetchAll($sql);
        //decorate rows in data models
        $all = array_map(fn($row) => new self($dateTime, $row), $all);
        //sorting by air time
        usort($all, fn(self $a, self $b) => $a->getDateTime() <=> $b->getDateTime());

        return $all;
    }
}
