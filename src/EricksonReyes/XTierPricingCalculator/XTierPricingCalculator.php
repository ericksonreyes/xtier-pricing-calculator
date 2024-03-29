<?php

namespace EricksonReyes\XTierPricingCalculator;

/**
 * Class XTierPricingCalculator
 * @package EricksonReyes\XTierPricingCalculator
 */
class XTierPricingCalculator implements XTierPricingCalculatorInterface
{
    /**
     * @var \EricksonReyes\XTierPricingCalculator\XTierInterface[]
     */
    private $tiers = [];

    /**
     * @param \EricksonReyes\XTierPricingCalculator\XTierInterface[] $tiers
     */
    public function __construct($tiers = [])
    {
        foreach ($tiers as $tier) {
            if ($tier instanceof XTierInterface === false) {
                throw new \InvalidArgumentException(
                    "Tiers must be instances of \EricksonReyes\XTierPricingCalculator\XTierInterface"
                );
            }
        }
        $this->tiers = $tiers;
    }

    /**
     * @param int $numberOfOrders
     * @return \EricksonReyes\XTierPricingCalculator\XTierPricingCalculatorResultInterface
     */
    public function compute($numberOfOrders = 0)
    {
        // Let's just make sure the number of orders will be an integer.
        $numberOfOrders = intval($numberOfOrders);

        // Create an instance of XTierPricingCalculatorResult
        $result = new XTierPricingCalculatorResult();

        // If there are no orders no need to proceed.
        if ($numberOfOrders < 0) {
            return $result;
        }

        // Set the number of remaining unbilled orders. Since all of orders at this moment are all assumed unbilled.
        $numberOfRemainingUnbilledOrders = intval($numberOfOrders);
        $billingStartIndex = 0;
        $runningCost = 0.00;

        // Loop though the tiers
        foreach ($this->tiers as $tier) {

            // Get maximum billable quantity based on the tier settings.
            $maximumNumberOfBillableOrders = abs($billingStartIndex - intval($tier->max()));

            // Determine if the tier has no upper bound limit.
            $hasNoUpperBoundLimit = intval($tier->max()) === 0;

            // If there is no maximum billable quantity set, use the  number of orders.
            if ($hasNoUpperBoundLimit) {
                $maximumNumberOfBillableOrders = $numberOfOrders;
            }

            // Set default billable quantity based on the remaining un-billed orders minus the previously
            // billed orders.
            $numberOfBillableOrders = $numberOfRemainingUnbilledOrders;

            // Set the maximum billable quantity as billable quantity if the billable quantity exceeds the limit.
            if ($maximumNumberOfBillableOrders > 0 && $numberOfBillableOrders > $maximumNumberOfBillableOrders) {
                $numberOfBillableOrders = $maximumNumberOfBillableOrders;
            }

            // Compute where billing will start.
            $billingStart = $billingStartIndex + 1;

            // Compute where the billing will stop.
            $billingEnd = $billingStartIndex + $numberOfBillableOrders;

            // If the tier has no upper bound limit, set billing end to the number of orders.
            if ($hasNoUpperBoundLimit) {
                $billingEnd = $numberOfOrders;
            }

            // Compute the amount to be billed.
            $price = floatval($numberOfBillableOrders * $tier->pricePerItem());

            // Compute the running cost.
            $runningCost = $runningCost + $price;

            // Create a result item result object.
            $resultItem = new XTierPricingCalculatorResultItem(
                $billingStart,
                $billingEnd,
                $numberOfBillableOrders,
                $price,
                $runningCost
            );
            $result->addResultItem($resultItem);

            // Subtract the billed orders from the remaining unbilled orders.
            $numberOfRemainingUnbilledOrders = $numberOfRemainingUnbilledOrders - $numberOfBillableOrders;

            // Use the billing end as the next starting billing index for continuity.
            $billingStartIndex = $billingEnd;

            if ($numberOfRemainingUnbilledOrders <= 0) {
                break; // No need to continue if all orders have been accounted for
            }

        }

        // Return the result object.
        return $result;
    }


}
