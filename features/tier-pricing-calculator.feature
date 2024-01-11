Feature: Tier Pricing Calculator
  As a Software Developer
  I want a tier pricing calculator
  So that I will be able to compute the amount to be billed using a volume based tier pricing

  Scenario Outline: Orders delivered is less than 100
    Given I have the following tier pricing
      | min_volume | max_volume | price |
      | 1          |            | 10.00 |
    And there are 197 orders delivered
    When I compute the amount to be billed
    Then the customer will be billed <tier_cost> per tier for <billable_orders> orders starting from <billing_start> to <billing_end> and the total cost will be <running_cost>
    And the total billable price is 1970.00

    Examples:
      | billing_start | billing_end | billable_orders | tier_cost | running_cost |
      | 1             | 197         | 197             | 1970.00   | 1970.00      |

  Scenario Outline: Orders delivered is less than 1000
    Given I have the following tier pricing
      | min_volume | max_volume | price |
      | 1          | 100        | 10.00 |
      | 101        |            | 5.00  |
    And there are 970 orders delivered
    When I compute the amount to be billed
    Then the customer will be billed <tier_cost> per tier for <billable_orders> orders starting from <billing_start> to <billing_end> and the total cost will be <running_cost>
    And the total billable price is 5350.00

    Examples:
      | billing_start | billing_end | billable_orders | tier_cost | running_cost |
      | 1             | 100         | 100             | 1000.00   | 1000.00      |
      | 101           | 970         | 870             | 4350.00   | 5350.00      |

  Scenario Outline: Orders delivered is less than 10000
    Given I have the following tier pricing
      | min_volume | max_volume | price |
      | 1          | 100        | 10.00 |
      | 101        |            | 5.00  |
    And there are 2970 orders delivered
    When I compute the amount to be billed
    Then the customer will be billed <tier_cost> per tier for <billable_orders> orders starting from <billing_start> to <billing_end> and the total cost will be <running_cost>
    And the total billable price is 15350.00

    Examples:
      | billing_start | billing_end | billable_orders | tier_cost | running_cost |
      | 1             | 100         | 100             | 1000.00   | 1000.00      |
      | 101           | 2970        | 2870            | 14350.00  | 15350.00     |

  Scenario Outline: Orders delivered is less than 10000. 3 Tier
    Given I have the following tier pricing
      | min_volume | max_volume | price |
      | 1          | 100        | 10.00 |
      | 101        | 1000       | 5.00  |
      | 1001       |            | 2.50  |
    And there are 2970 orders delivered
    When I compute the amount to be billed
    Then the customer will be billed <tier_cost> per tier for <billable_orders> orders starting from <billing_start> to <billing_end> and the total cost will be <running_cost>
    And the total billable price is 10425.00

    Examples:
      | billing_start | billing_end | billable_orders | tier_cost | running_cost |
      | 1             | 100         | 100             | 1000.00   | 1000.00      |
      | 101           | 1000        | 900             | 4500.00   | 5500.00      |
      | 1001          | 2970        | 1970            | 4925.00   | 10425.00     |

  Scenario Outline: Orders delivered is greater than 10000. 4 Tier
    Given I have the following tier pricing
      | min_volume | max_volume | price |
      | 1          | 100        | 10.00 |
      | 101        | 1000       | 5.00  |
      | 1001       | 10000      | 2.50  |
      | 10001      |            | 1.50  |
    And there are 12970 orders delivered
    When I compute the amount to be billed
    Then the customer will be billed <tier_cost> per tier for <billable_orders> orders starting from <billing_start> to <billing_end> and the total cost will be <running_cost>
    And the total billable price is 32455.00

    Examples:
      | billing_start | billing_end | billable_orders | tier_cost | running_cost |
      | 1             | 100         | 100             | 1000.00   | 1000.00      |
      | 101           | 1000        | 900             | 4500.00   | 5500.00      |
      | 1001          | 10000       | 9000            | 22500.00  | 28000.00     |
      | 10001         | 12970       | 2970            | 4455.00   | 32455.00     |