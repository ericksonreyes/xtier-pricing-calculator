<?php

namespace spec\EricksonReyes\XTierPricingCalculator;

use EricksonReyes\XTierPricingCalculator\XTierPricingCalculator;
use EricksonReyes\XTierPricingCalculator\XTierPricingCalculatorInterface;
use EricksonReyes\XTierPricingCalculator\XTierPricingCalculatorResultInterface;
use PhpSpec\ObjectBehavior;

/**
 * Class XTierPricingCalculatorSpec
 * @package spec\EricksonReyes\XTierPricingCalculator
 */
class XTierPricingCalculatorSpec extends ObjectBehavior
{

    /**
     * @return void
     */
    function it_is_initializable()
    {
        $this->shouldHaveType(XTierPricingCalculator::class);
        $this->shouldHaveType(XTierPricingCalculatorInterface::class);
    }

    public function it_computes_tier_pricing()
    {
        $this->compute()->shouldHaveType(XTierPricingCalculatorResultInterface::class);
    }

}
