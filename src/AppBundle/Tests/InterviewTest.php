<?php

namespace AppBundle\Tests;

use AppBundle\Interview\Customer;
use AppBundle\Interview\FixedDiscount;
use AppBundle\Interview\Order;
use AppBundle\Interview\OrderCategory;
use AppBundle\Interview\PercentDiscount;

class InterviewTest extends \PHPUnit_Framework_TestCase
{
    public function testInterview()
    {
        // Don't change code in this file, just make it work

        $customer = new Customer('John Black');

        // orders
        $customer->addOrder(new Order('LCD', OrderCategory::HARDWARE, 220));
        $customer->addOrder(new Order('Mouse', OrderCategory::HARDWARE, 30));
        $customer->addOrder(new Order('Keyboard', OrderCategory::HARDWARE, 45));
        $customer->addOrder(new Order('OS', OrderCategory::SOFTWARE, 90));
        $customer->addOrder(new Order('Minesweeper deluxe', OrderCategory::SOFTWARE, 1200));
        $customer->addOrder(new Order('Delivery', OrderCategory::SERVICES, 25));
        $customer->addOrder(new Order('Installation', OrderCategory::SERVICES, 60));

        // discounts
        // percent: amount * (100-percent) / 100
        // fixed: amount - value
        // All fixed are applied before percent
        $customer->addDiscount(OrderCategory::HARDWARE, new PercentDiscount(10));
        $customer->addDiscount(OrderCategory::HARDWARE, new FixedDiscount(15));
        $customer->addDiscount(OrderCategory::SOFTWARE, new PercentDiscount(20));

        $hardwareTotal = $customer->getTotalPriceByOrderCategory(OrderCategory::HARDWARE);
        $hardwareTotalWithDiscount = $customer->getTotalPriceWithDiscountByOrderCategory(OrderCategory::HARDWARE);
        $total = $customer->getTotalPriceWithDiscount();

        $this->assertEquals(220 + 30 + 45, $hardwareTotal);
        $this->assertEquals((220 + 30 + 45 - 15) * (100 - 10) / 100, $hardwareTotalWithDiscount);
        $this->assertEquals((220 + 30 + 45 - 15) * (100 - 10) / 100 + (90 + 1200) * (100 - 20) / 100 + 25 + 60, $total);

        // bonus: add new discount for services with rule when amount > 50 subtracts 10 otherwise 0
    }
}
