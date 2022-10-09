<?php

require dirname(__DIR__) . '/vendor/autoload.php';

use Svit\Exads\ABTest;

$experimentId = $argv[1] ?? 1;
$abTest = new ABTest($experimentId);

$design = $abTest->getRandomDesign();

//todo redirect to corresponded design page in web server env

echo "Redirecting to design.php $experimentId {$design['designId']}", PHP_EOL;

//see design.php <experiment-id> <design-id>
