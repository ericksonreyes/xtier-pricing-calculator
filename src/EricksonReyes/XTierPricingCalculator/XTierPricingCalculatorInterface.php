<?php

namespace EricksonReyes\XTierPricingCalculator;


/**
 * Interface XTierPricingInterface
 * @package EricksonReyes\XTierPricingCalculator
 */
interface XTierPricingCalculatorInterface
{

    /**
     * @param int $numberOfOrdersDelivered
     * @return \EricksonReyes\XTierPricingCalculator\XTierPricingCalculatorResultInterface
     */
    public function compute($numberOfOrdersDelivered = 0);
}