<?php

namespace spec\EricksonReyes\XTierPricingCalculator;

use EricksonReyes\XTierPricingCalculator\XTierPricingCalculatorResultItem;
use EricksonReyes\XTierPricingCalculator\XTierPricingCalculatorResultItemInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class XTierPricingCalculatorResultItemSpec
 * @package spec\EricksonReyes\XTierPricingCalculator
 */
class XTierPricingCalculatorResultItemSpec extends ObjectBehavior
{
    /**
     * @return void
     */
    function it_is_initializable()
    {
        $this->shouldHaveType(XTierPricingCalculatorResultItem::class);
        $this->shouldHaveType(XTierPricingCalculatorResultItemInterface::class);
    }
}
