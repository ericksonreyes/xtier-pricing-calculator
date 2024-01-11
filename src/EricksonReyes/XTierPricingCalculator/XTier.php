<?php

namespace EricksonReyes\XTierPricingCalculator;

/**
 * Class XTier
 * @package EricksonReyes\XTierPricingCalculator
 */
class XTier implements XTierInterface
{

    /**
     * @var int
     */
    private $min = 0.00;

    /**
     * @var int|null
     */
    private $max = null;

    /**
     * @var float
     */
    private $pricePerItem = 0.00;

    /**
     * @param int $min
     * @param int|null $max
     * @param float $pricePerItem
     */
    public function __construct($min, $max = null, $pricePerItem = 0.00)
    {
        $this->min = $min;
        $this->max = $max;
        $this->pricePerItem = $pricePerItem;
    }


    /**
     * @return int
     */
    public function min()
    {
        return $this->min;
    }

    /**
     * @return int|null
     */
    public function max()
    {
        return $this->max;
    }

    /**
     * @return float
     */
    public function pricePerItem()
    {
        return $this->pricePerItem;
    }


}
