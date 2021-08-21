<?php

namespace App\Tests;

use App\Services\PromotionalCalculator;
use PHPUnit\Framework\TestCase;

class PromotionalCalculatorTest extends TestCase
{
    public function testSomething(): void
    {
        $calculator = $this->getMockBuilder(PromotionalCalculator::class)
                            ->onlyMethods(['getPromotionPercentage'])
                            ->getMock();

        $calculator->expects($this->any())
        ->method('getPromotionPercentage')
        ->willReturn(0.2);

        $result = $calculator->calculatePriceAfterPromotion(1, 9);

        $this->assertEquals(8, $result);

        $result = $calculator->calculatePriceAfterPromotion(10, 20, 50);

        $this->assertEquals(64, $result);

        $this->assertTrue(true);
    }
}
