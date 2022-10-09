<?php

require dirname(__DIR__) . '/vendor/autoload.php';

use Svit\Exads\ABTest;

$abTest = new ABTest($argv[1]);

$experiment = $abTest->getExperiment();
$design = $experiment->getDesign($argv[2]);

echo "Page '{$design['designName']}' for promo '{$experiment->getPromotionName()}'", PHP_EOL;
