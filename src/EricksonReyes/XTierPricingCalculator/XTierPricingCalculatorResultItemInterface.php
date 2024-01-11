<?php

namespace EricksonReyes\XTierPricingCalculator;


/**
 * Interface XTierPricingCalculatorResultItem
 * @package EricksonReyes\XTierPricingCalculator
 */
interface XTierPricingCalculatorResultItemInterface
{

    /**
     * @return int
     */
    public function billingStart();

    /**
     * @return int
     */
    public function billingEnd();

    /**
     * @return int
     */
    public function count();

    /**
     * @return float
     */
    public function price();

    /**
     * @return float
     */
    public function runningCost();
}