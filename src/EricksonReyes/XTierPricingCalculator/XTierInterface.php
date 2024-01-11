<?php

namespace EricksonReyes\XTierPricingCalculator;


/**
 * Interface XTierInterface
 * @package EricksonReyes\XTierPricingCalculator
 */
interface XTierInterface
{

    /**
     * @return int
     */
    public function min();

    /**
     * @return int|null
     */
    public function max();

    /**
     * @return float
     */
    public function pricePerItem();
}