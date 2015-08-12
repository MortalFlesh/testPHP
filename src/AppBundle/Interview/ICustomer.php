<?php

namespace AppBundle\Interview;

interface ICustomer
{
    /**
     * @param string $orderCategory
     * @param Discount $discount
     */
    public function addDiscount($orderCategory, Discount $discount);

    /**
     * @param Order $order
     */
    public function addOrder(Order $order);

    /**
     * @param string $orderCategory
     * @return float
     */
    public function getTotalPriceByOrderCategory($orderCategory);

    /**
     * @param string $orderCategory
     * @return float
     */
    public function getTotalPriceWithDiscountByOrderCategory($orderCategory);

    /**
     * @return float
     */
    public function getTotalPriceWithDiscount();
}
