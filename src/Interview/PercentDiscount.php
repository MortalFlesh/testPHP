<?php declare(strict_types=1);

namespace App\Interview;

class PercentDiscount extends Discount
{
    public function __construct(private float $percentValue)
    {
    }

    public function getPriority(): int
    {
        return self::PRIORITY_LOW;
    }

    public function apply(float $amount): float
    {
        return $amount * (100 - $this->percentValue) / 100;
    }
}
