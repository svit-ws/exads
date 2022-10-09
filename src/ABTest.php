<?php

namespace Svit\Exads;

use Exads\ABTestData;

class ABTest
{
    private ABTestData $experiment;

    public function __construct(int $promoId)
    {
        $this->experiment = new ABTestData($promoId);
    }

    public function getExperiment(): ABTestData
    {
        return $this->experiment;
    }

    public function getRandomDesign(): ?array
    {
        $rand = rand(1, 100);
        $designs = $this->experiment->getAllDesigns();

        foreach ($designs as $design) {
            $rand -= $design['splitPercent'];
            if ($rand <= 0) {
                break;
            }
        }

        return $design ?? null;
    }
}
