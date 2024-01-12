<?php

namespace EricksonReyes\XTierPricingCalculator;


/**
 * Interface XTierPricingInterface
 * @package EricksonReyes\XTierPricingCalculator
 */
interface XTierPricingCalculatorInterface
{

    /**
     * @param int $numberOfOrders
     * @return \EricksonReyes\XTierPricingCalculator\XTierPricingCalculatorResultInterface
     */
    public function compute($numberOfOrders = 0);
}