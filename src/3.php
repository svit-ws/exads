<?php
/**
 * Example: php src/3.php now "filter criteria"
 */

use Svit\Exads\TvSeries;

require dirname(__DIR__) . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$dateTime = new DateTime($argv[1] ?? 'now');
$filter = $argv[2] ?? null;

foreach (TvSeries::find($dateTime, $filter) as $model) {
    echo "$model->title on channel $model->channel at ", $model->getDateTime(), PHP_EOL;
}
