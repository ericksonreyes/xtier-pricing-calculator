<?php

namespace EricksonReyes\XTierPricingCalculator;

/**
 * Class XTierPricingCalculatorResultItem
 * @package EricksonReyes\XTierPricingCalculator
 */
class XTierPricingCalculatorResultItem implements XTierPricingCalculatorResultItemInterface
{

    /**
     * @var int
     */
    private $billingStart;

    /**
     * @var int
     */
    private $billingEnd;

    /**
     * @var int
     */
    private $count;

    /**
     * @var float
     */
    private $price;

    /**
     * @var float
     */
    private $runningCost;

    /**
     * @param int $billingStart
     * @param int $billingEnd
     * @param int $count
     * @param float $price
     */
    public function __construct($billingStart, $billingEnd, $count, $price, $runningCost)
    {
        $this->billingStart = $billingStart;
        $this->billingEnd = $billingEnd;
        $this->count = $count;
        $this->price = $price;
        $this->runningCost = $runningCost;
    }


    /**
     * @return int
     */
    public function billingStart()
    {
        return $this->billingStart;
    }

    /**
     * @return int
     */
    public function billingEnd()
    {
        return $this->billingEnd;
    }

    /**
     * @return int
     */
    public function count()
    {
        return $this->count;
    }

    /**
     * @return float
     */
    public function price()
    {
        return $this->price;
    }

    /**
     * @return float
     */
    public function runningCost()
    {
        return $this->runningCost;
    }


}
