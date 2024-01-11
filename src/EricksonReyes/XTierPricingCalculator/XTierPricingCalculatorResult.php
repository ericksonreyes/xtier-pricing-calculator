<?php

namespace EricksonReyes\XTierPricingCalculator;

/**
 * Class XTierPricingCalculatorResult
 * @package EricksonReyes\XTierPricingCalculator
 */
class XTierPricingCalculatorResult implements XTierPricingCalculatorResultInterface
{
    /**
     * @var XTierPricingCalculatorResultItemInterface[]
     */
    private $breakdown = [];

    /**
     * @param \EricksonReyes\XTierPricingCalculator\XTierPricingCalculatorResultItemInterface $resultItem
     * @return void
     */
    public function addResultItem(XTierPricingCalculatorResultItemInterface $resultItem)
    {
        $this->breakdown[] = $resultItem;
    }


    /**
     * @return XTierPricingCalculatorResultItemInterface[]
     */
    public function breakdown()
    {
        return $this->breakdown;
    }

    /**
     * @return float
     */
    public function total()
    {
        $total = 0.00;
        foreach ($this->breakdown as $resultItem) {
            $total += $resultItem->price();
        }
        return $total;
    }

}
