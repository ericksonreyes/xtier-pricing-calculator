<?php

namespace EricksonReyes\XTierPricingCalculator;


/**
 * Interface XTierPricingInterface
 * @package EricksonReyes\XTierPricingCalculator
 */
interface XTierPricingCalculatorInterface
{

    /**
     * @param int $quantity
     * @return \EricksonReyes\XTierPricingCalculator\XTierPricingCalculatorResultInterface
     */
    public function compute($quantity = 0);
}