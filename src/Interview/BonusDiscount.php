<?php declare(strict_types=1);

namespace App\Interview;

class BonusDiscount extends Discount
{
    public function getPriority(): int
    {
        return self::PRIORITY_HIGH;
    }

    public function apply(float $amount): float
    {
        return $amount > 50
            ? $amount - 10
            : $amount;
    }
}
