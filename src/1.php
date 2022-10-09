<?php

function multipleOf($num): array
{
    $result = [];
    $max = sqrt($num);
    for ($i = 2; $i <= $max; $i++) {
        if ($num % $i === 0) {
            $result[] = $i;
            if (($div = $num / $i) > $i) {
                $result[] = $div;
            }
        }
    }
    sort($result);

    return $result;
}

for ($i = 1; $i <= 100; $i++) {
    $value = ($div = multipleOf($i)) ? implode(',', $div) : 'PRIME';
    echo "$i [$value]" . PHP_EOL;
}
