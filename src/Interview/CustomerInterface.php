<?php declare(strict_types=1);

namespace App\Interview;

interface CustomerInterface
{
    public function addDiscount(string $orderCategory, Discount $discount): void;

    public function addOrder(Order $order): void;

    public function getTotalPriceByOrderCategory(string $orderCategory): float;

    public function getTotalPriceWithDiscountByOrderCategory(string $orderCategory): float;

    public function getTotalPriceWithDiscount(): float;
}
