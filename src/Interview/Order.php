<?php declare(strict_types=1);

namespace App\Interview;

class Order
{
    public function __construct(private string $itemName, private string $orderCategory, private float $price)
    {
    }

    public function getOrderCategory(): string
    {
        return $this->orderCategory;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getItemName(): string
    {
        return $this->itemName;
    }
}
