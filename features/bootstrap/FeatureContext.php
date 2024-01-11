<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use EricksonReyes\XTierPricingCalculator\XTier;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{

    /**
     * @var int
     */
    private $volume = 0;

    /**
     * @var \EricksonReyes\XTierPricingCalculator\XTierInterface[]
     */
    private $tiers = [];
    /**
     * @var \EricksonReyes\XTierPricingCalculator\XTierPricingCalculatorResultInterface
     */
    private $result;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @Given I have the following tier pricing
     */
    public function iHaveTheFollowingTierPricing(TableNode $table)
    {
        $tiers = $table->getHash();

        foreach ($tiers as $tier) {
            $this->tiers[] = new XTier(
                intval($tier['min_volume']),
                intval($tier['max_volume']),
                floatval($tier['price'])
            );
        }
    }

    /**
     * @Given there are :arg1 orders delivered
     */
    public function thereAreOrdersDelivered($volume)
    {
        $this->volume = $volume;
    }

    /**
     * @When I compute the amount to be billed
     */
    public function iComputeTheAmountToBeBilled()
    {
        $calculator = new \EricksonReyes\XTierPricingCalculator\XTierPricingCalculator($this->tiers);
        $this->result = $calculator->compute($this->volume);
    }


    /**
     * @Then the customer will be billed :arg1 per tier for :arg2 orders starting from :arg3 to :arg4 and the total cost will be :arg5
     */
    public function theCustomerWillBeBilledPerTierForOrdersStartingFromToAndTheTotalCostWillBe($price, $count, $billingStart, $billingEnd, $runningCost)
    {
        $breakdown = $this->result->breakdown();

        $showDebug = true;
        $mismatches = [];
        $hasMatch = false;
        foreach ($breakdown as $item) {
            if (
                $item->price() === floatval($price) &&
                $item->count() === intval($count) &&
                $item->billingStart() === intval($billingStart) &&
                $item->billingEnd() === intval($billingEnd) &&
                $item->runningCost() === floatval($runningCost)
            ) {
                $hasMatch = true;
            } else {
                $mismatches[] = [
                    'actual billingStart: '. $item->billingStart() => 'expected ' . intval($billingStart),
                    'actual billingEnd: '. $item->billingEnd() => 'expected ' . intval($billingEnd),
                    'actual billableQuantity: '. $item->count() => 'expected ' . intval($count),
                    'actual price: '. $item->price() => 'expected ' . floatval($price),
                    'actual runningCost: '. $item->runningCost() => 'expected ' . floatval($runningCost)
                ];
            }
        }

        if ($showDebug === true && empty($mismatches) === false && $hasMatch === false) {
            print_r($mismatches);
        }
        assert($hasMatch === true, "Tier item not found.");
    }

}
