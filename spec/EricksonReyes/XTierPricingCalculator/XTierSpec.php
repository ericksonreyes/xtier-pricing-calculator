<?php

namespace spec\EricksonReyes\XTierPricingCalculator;

use EricksonReyes\XTierPricingCalculator\XTier;
use EricksonReyes\XTierPricingCalculator\XTierInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class XTierSpec
 * @package spec\EricksonReyes\XTierPricingCalculator
 */
class XTierSpec extends ObjectBehavior
{
    /**
     * @return void
     */
    function it_is_initializable()
    {
        $this->shouldHaveType(XTier::class);
        $this->shouldHaveType(XTierInterface::class);
    }
}
