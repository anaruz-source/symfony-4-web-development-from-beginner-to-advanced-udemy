<?php

namespace App\Services;

class PromotionalCalculator
{
    public function calculatePriceAfterPromotion(...$prices)
    {
        $initial = 0;

        foreach ($prices as $p) {
            $initial += $p;
        }

        return $initial - $initial * $this->getPromotionPercentage();
    }

    public function getPromotionPercentage()
    {
        return (int) \file_get_contents('percent.txt');
    }
}
