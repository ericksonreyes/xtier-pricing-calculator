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
     * @param int $numberOfItemsDelivered
     * @return \EricksonReyes\XTierPricingCalculator\XTierPricingCalculatorResultInterface
     */
    public function compute($numberOfItemsDelivered = 0)
    {
        $numberOfItemsDelivered = intval($numberOfItemsDelivered);
        $result = new XTierPricingCalculatorResult();
        if ($numberOfItemsDelivered < 0) {
            return $result;
        }

        $remainingUnbilledOrders = intval($numberOfItemsDelivered);
        $billingStartIndex = 0;
        $runningCost = 0.00;

        // Loop though the tiers
        foreach ($this->tiers as $tier) {

            // If the number of items delivered meets the minimum tier requirement.
            if ($remainingUnbilledOrders >= $tier->min()) {

                // Set maximum billable quantity based on the tier
                $maximumBillableQuantity = intval($tier->max());

                // Determine if the tier has no upper bound limit
                $hasUpperBoundLimit = $maximumBillableQuantity === 0;

                // If there is no maximum billable quantity set (which means beyond), use the  number of orders
                // delivered.
                if ($hasUpperBoundLimit) {
                    $maximumBillableQuantity = $numberOfItemsDelivered;
                }

                // Set default billable quantity based on the remaining un-billed orders.
                $billableQuantity = $remainingUnbilledOrders;

                // Set the maximum billable quantity as billable quantity if the billable quantity exceeds the limit.
                if ($maximumBillableQuantity > 0 && $billableQuantity >= $maximumBillableQuantity) {
                    $billableQuantity = $maximumBillableQuantity;
                }

                // Compute where billing will start
                $billingStart = $billingStartIndex + 1;

                // Compute where the billing will stop
                $billingEnd = $billingStartIndex + $billableQuantity;

                // If the tier has no upper bound limit, set billing end to the number of orders delivered.
                if ($hasUpperBoundLimit) {
                    $billingEnd = $numberOfItemsDelivered;
                }

                // Set the end index to the maximum billable quantity if the end index exceeds the limit.
                if ($billingEnd >= $maximumBillableQuantity) {
                    $billingEnd = $maximumBillableQuantity;
                }

                // Compute the amount to be billed.
                $price = floatval($billableQuantity * $tier->pricePerItem());

                // Compute the running cost.
                $runningCost = $runningCost + $price;

                // Create a result item result object.
                $resultItem = new XTierPricingCalculatorResultItem(
                    $billingStart,
                    $billingEnd,
                    $billableQuantity,
                    $price,
                    $runningCost
                );
                $result->addResultItem($resultItem);

                // Compute the remaining orders to be billed.
                $remainingUnbilledOrders = $remainingUnbilledOrders - $billableQuantity;

                // Set tne next start index
                $billingStartIndex = $billingEnd;

                if ($remainingUnbilledOrders <= 0) {
                    break; // No need to continue if all orders have been accounted for
                }
            }

        }

        return $result;
    }


}
