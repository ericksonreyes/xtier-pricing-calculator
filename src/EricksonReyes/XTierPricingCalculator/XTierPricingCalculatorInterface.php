<?php

namespace EricksonReyes\XTierPricingCalculator;


/**
 * Interface XTierPricingInterface
 * @package EricksonReyes\XTierPricingCalculator
 */
interface XTierPricingCalculatorInterface
{

    /**
     * @param int $numberOfItemsDelivered
     * @return \EricksonReyes\XTierPricingCalculator\XTierPricingCalculatorResultInterface
     */
    public function compute($numberOfItemsDelivered = 0);
}