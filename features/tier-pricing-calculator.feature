Feature: Tier Pricing Calculator
  As a Software Developer
  I want a tier pricing calculator
  So that I will be able to compute the amount to be billed using a volume based tier pricing

  Background:
    Given I have the following tier pricing
      | min_volume | max_volume | price  |
      | 1          | 100        | 10.00  |
      | 101        | 1000       | 20.00  |
      | 1001       |            | 100.00 |

  Scenario Outline: Volume is less than 100
    Given the volume is 97.00
    When I compute the amount to be billed
    Then the customer will be billed <tier_cost> per tier for <number_of_orders> orders starting from <billing_start> to <billing_end> and the total cost will be <running_cost>

    Examples:
      | billing_start | billing_end | number_of_orders | tier_cost | running_cost |
      | 1             | 97          | 97               | 970.00    | 970.00       |

  Scenario Outline: Volume is less than 1000
    Given the volume is 797.00
    When I compute the amount to be billed
    Then the customer will be billed <tier_cost> per tier for <number_of_orders> orders starting from <billing_start> to <billing_end> and the total cost will be <running_cost>

    Examples:
      | billing_start | billing_end | number_of_orders | tier_cost | running_cost |
      | 1             | 100         | 100              | 1000.00   | 1000.00      |
      | 101           | 797         | 697              | 13940.00  | 14940.00     |

  @test
  Scenario Outline: Volume exceeds 1000
    Given the volume is 8213
    When I compute the amount to be billed
    Then the customer will be billed <tier_cost> per tier for <number_of_orders> orders starting from <billing_start> to <billing_end> and the total cost will be <running_cost>

    Examples:
      | billing_start | billing_end | number_of_orders | tier_cost | running_cost |
      | 1             | 100         | 100              | 1000.00   | 1000.00      |
      | 101           | 1000        | 1000             | 20000.00  | 21000.00     |
      | 1001          | 8213        | 7113             | 711300.00 | 732300.00    |
