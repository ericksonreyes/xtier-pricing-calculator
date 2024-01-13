# Tier Pricing Calculator

## Requirement
* PHP 5.6 to PHP 8

## Installation
```shell
composer install
```

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

// Do some DB query or any method of extracting item count.
$query = $db->query("SELECT COUNT(`id`) as 'order_count' FROM `orders` WHERE `seller_id` = 1");
$itemCount = intval($query['order_count']);

// Compute the tier pricing
$result = $calculator->compute($itemCount);

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

### Adding acceptance test scenarios
Add new scenarios in the [tier-pricing-calculator.feature](features/tier-pricing-calculator.feature)

### Running the acceptance test scenarios
```shell
php vendor/bin/behat
```