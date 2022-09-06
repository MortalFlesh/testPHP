<?php declare(strict_types=1);

namespace App\Interview;

class FixedDiscount extends Discount
{
    public function __construct(private float $amount)
    {
    }

    public function getPriority(): int
    {
        return self::PRIORITY_HIGH;
    }

    public function apply(float $amount): float
    {
        return $amount - $this->amount;
    }
}
