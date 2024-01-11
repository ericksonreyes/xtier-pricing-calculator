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
     * @param int $quantity
     * @return \EricksonReyes\XTierPricingCalculator\XTierPricingCalculatorResultInterface
     */
    public function compute($quantity = 0)
    {
        $result = new XTierPricingCalculatorResult();
        if ($quantity < 0) {
            return $result;
        }

        $start = 1;
        $runningCost = 0.00;

        foreach ($this->tiers as $tier) {

            if ($quantity >= $tier->min()) {

                $max = $quantity;
                if ($tier->max() > 0) {
                    $max = $tier->max();
                }

                $tierCount = intval($quantity / $max);
                $billableQuantity = $quantity % $max;
                if ($tierCount > 0) {
                    $billableQuantity = $max;
                }

                $end = ($start + $billableQuantity) - 1;
                $price = floatval($billableQuantity * $tier->pricePerItem());
                $runningCost = $runningCost + $price;

                echo "\ntierCount: " . $tierCount;
                echo "\nstart: " . $start;
                echo "\nend: " . $end;
                echo "\nmax: " . $max;
                echo "\nquantity: " . $quantity;
                echo "\nbillableQuantity: " . $billableQuantity;

                $resultItem = new XTierPricingCalculatorResultItem(
                    $start,
                    $end,
                    $billableQuantity,
                    $price,
                    $runningCost
                );
                $result->addResultItem($resultItem);

                $start = $end + 1;
                $quantity = $quantity - $billableQuantity;

                echo "\nprice: " . $price;
                echo "\nrunningCost: " . $runningCost;
                echo "\nremainingQuantity: " . $quantity;
                echo "\n";
                if ($quantity <= 0) {
                    break; // No need to continue if all orders have been accounted for
                }
            }
        }

        return $result;
    }


}
