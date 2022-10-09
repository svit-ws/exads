<?php
//define sequence
$sequence = range(ord(','), ord('|'));
//prepare rand array
$chars = array_map('chr', $sequence);
shuffle($chars);
//remove random element
$randKey = array_rand($chars);

unset($chars[$randKey]);
//calc initial sequence sum
$initial = array_sum($sequence);
//calc modified sequence sum
$modified = array_sum(array_map('ord', $chars));

$missed = $initial - $modified;

echo 'Missed char is ', chr($missed), PHP_EOL;
