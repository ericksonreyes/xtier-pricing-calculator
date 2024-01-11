# Tier Pricing Calculator

## Installation
* composer install

## Usage

```php
$matrix = array(
    array('min_volume' => 1, 'max_volume' => 100, 'price' => 10.00),
    array('min_volume' => 1, 'max_volume' => 1000, 'price' => 10.00),
    array('min_volume' => 1, 'max_volume' => null, 'price' => 10.00)
)

// Prepare tier matrix
$tiers = array();
foreach ($matrix as $tier) {
    $tiers[] = new \EricksonReyes\XTierPricingCalculator\XTier(
        $tier['min_volume'],
        $tier['max_volume'],
        $tier['price']
    );
}

// Instantiate pricing calculator
$calculator = new \EricksonReyes\XTierPricingCalculator\XTierPricingCalculator($tiers);

// Compute the tier pricing
$result = $calculator->compute($this->volume);

// Process the result
foreach ($result->breakdown() as $resultItem) {
    echo "\nStart of billing: " . $resultItem->billingStart();
    echo "\nEnd of billing: " . $resultItem->billingEnd();
    echo "\nNumber of billable orders: " . $resultItem->count();
    echo "\nPrice of billed orders: " . $resultItem->price();
    echo "\nRunning total price:" . $resultItem->runningCost();
}

echo "\nTotal billable price: "$result->total();
```

### Adding test scenarios
Add new scenarios in the [tier-pricing-calculator.feature](features/tier-pricing-calculator.feature)