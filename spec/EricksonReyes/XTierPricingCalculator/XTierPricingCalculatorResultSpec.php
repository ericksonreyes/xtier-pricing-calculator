<?php

namespace spec\EricksonReyes\XTierPricingCalculator;

use EricksonReyes\XTierPricingCalculator\XTierPricingCalculatorResult;
use EricksonReyes\XTierPricingCalculator\XTierPricingCalculatorResultInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class XTierPricingCalculatorResultSpec
 * @package spec\EricksonReyes\XTierPricingCalculator
 */
class XTierPricingCalculatorResultSpec extends ObjectBehavior
{
    /**
     * @return void
     */
    function it_is_initializable()
    {
        $this->shouldHaveType(XTierPricingCalculatorResult::class);
        $this->shouldHaveType(XTierPricingCalculatorResultInterface::class);
    }
}
