<?php declare(strict_types=1);

namespace App\Interview;

abstract class Discount
{
    protected const PRIORITY_HIGH = 10;
    protected const PRIORITY_LOW = 0;

    abstract public function getPriority(): int;

    abstract public function apply(float $amount): float;
}
