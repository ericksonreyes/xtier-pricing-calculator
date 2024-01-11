Feature: Tier Pricing Calculator
  As a Software Developer
  I want a tier pricing calculator
  So that I will be able to compute the amount to be billed using a volume based tier pricing

  Scenario Outline: Orders delivered is less than 100
    Given I have the following tier pricing
      | min_volume | max_volume | price  |
      | 1          | 100        | 10.00  |
      | 101        | 1000       | 20.00  |
      | 1001       |            | 100.00 |
    And there are 97 orders delivered
    When I compute the amount to be billed
    Then the customer will be billed <tier_cost> per tier for <number_of_orders> orders starting from <billing_start> to <billing_end> and the total cost will be <running_cost>

    Examples:
      | billing_start | billing_end | number_of_orders | tier_cost | running_cost |
      | 1             | 97          | 97               | 970.00    | 970.00       |

  Scenario Outline: Orders delivered is less than 1000
    Given I have the following tier pricing
      | min_volume | max_volume | price  |
      | 1          | 100        | 10.00  |
      | 101        | 1000       | 20.00  |
      | 1001       |            | 100.00 |
    And there are 797 orders delivered
    When I compute the amount to be billed
    Then the customer will be billed <tier_cost> per tier for <number_of_orders> orders starting from <billing_start> to <billing_end> and the total cost will be <running_cost>

    Examples:
      | billing_start | billing_end | number_of_orders | tier_cost | running_cost |
      | 1             | 100         | 100              | 1000.00   | 1000.00      |
      | 101           | 797         | 697              | 13940.00  | 14940.00     |

  @test
  Scenario Outline: Orders delivered exceeds 1000
    Given I have the following tier pricing
      | min_volume | max_volume | price  |
      | 1          | 100        | 10.00  |
      | 101        | 1000       | 20.00  |
      | 1001       |            | 100.00 |
    And there are 8213 orders delivered
    When I compute the amount to be billed
    Then the customer will be billed <tier_cost> per tier for <number_of_orders> orders starting from <billing_start> to <billing_end> and the total cost will be <running_cost>

    Examples:
      | billing_start | billing_end | number_of_orders | tier_cost | running_cost |
      | 1             | 100         | 100              | 1000.00   | 1000.00      |
      | 101           | 1000        | 900              | 18000.00  | 19000.00     |
      | 1001          | 8213        | 7113             | 711300.00 | 730300.00    |


  Scenario Outline: Orders delivered exceeds 10000
    Given I have the following tier pricing
      | min_volume | max_volume | price |
      | 1          | 100        | 10.00 |
      | 101        | 1000       | 20.00 |
      | 1001       | 10000      | 30.00 |
      | 10001      |            | 50.00 |
    And there are 22500 orders delivered
    When I compute the amount to be billed
    Then the customer will be billed <tier_cost> per tier for <number_of_orders> orders starting from <billing_start> to <billing_end> and the total cost will be <running_cost>

    Examples:
      | billing_start | billing_end | number_of_orders | tier_cost | running_cost |
      | 1             | 100         | 100              | 1000.00   | 1000.00      |
      | 101           | 1000        | 900              | 18000.00  | 19000.00     |
      | 1001          | 20000       | 19000            | 570000.00 | 589000.00    |
      | 20001         | 22500       | 2500             | 125000.00 | 714000.00    |