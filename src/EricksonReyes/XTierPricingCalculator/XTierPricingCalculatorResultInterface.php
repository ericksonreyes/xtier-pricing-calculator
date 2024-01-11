<?php

namespace EricksonReyes\XTierPricingCalculator;


/**
 * Interface XTierPricingCalculatorResultInterface
 * @package EricksonReyes\XTierPricingCalculator
 */
interface XTierPricingCalculatorResultInterface
{

    /**
     * @param \EricksonReyes\XTierPricingCalculator\XTierPricingCalculatorResultItemInterface $resultItem
     * @return void
     */
    public function addResultItem(XTierPricingCalculatorResultItemInterface $resultItem);

    /**
     * @return XTierPricingCalculatorResultItemInterface[]
     */
    public function breakdown();

    /**
     * @return float
     */
    public function total();
}