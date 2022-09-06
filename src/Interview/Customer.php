<?php declare(strict_types=1);

namespace App\Interview;

use MF\Collection\Immutable\Generic\IList;
use MF\Collection\Immutable\Generic\IMap;
use MF\Collection\Immutable\Generic\ListCollection;
use MF\Collection\Immutable\Generic\Map;

class Customer
{
    /** @phpstan-var IMap<string, IList<Order>> */
    private IMap $orders;
    /** @phpstan-var IMap<string, IList<Discount>> */
    private IMap $discounts;

    public function __construct(private string $name)
    {
        $this->orders = new Map();
        $this->discounts = new Map();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function addOrder(Order $order): void
    {
        $category = $order->getOrderCategory();
        if (!$this->orders->containsKey($category)) {
            $this->orders = $this->orders->set($category, new ListCollection());
        }

        $this->orders = $this->orders->set(
            $category,
            $this->orders->get($category)->add($order),
        );
    }

    public function addDiscount(string $category, Discount $discount): void
    {
        if (!$this->discounts->containsKey($category)) {
            $this->discounts = $this->discounts->set($category, new ListCollection());
        }

        $this->discounts = $this->discounts->set(
            $category,
            $this->discounts->get($category)->add($discount),
        );
    }

    public function getTotalPriceByOrderCategory(string $category): float
    {
        return $this->orders
            ->get($category)
            ->sumBy(fn (Order $order) => $order->getPrice());
    }

    public function getTotalPriceWithDiscountByOrderCategory(string $category): float
    {
        return $this->discounts->containsKey($category)
            ? $this->discounts
                ->get($category)
                ->sortByDescending(fn (Discount $discount) => $discount->getPriority())
                ->reduce(
                    fn (float $price, Discount $discount) => $discount->apply($price),
                    $this->getTotalPriceByOrderCategory($category),
                )
            : $this->getTotalPriceByOrderCategory($category);
    }

    public function getTotalPriceWithDiscount(): float
    {
        return $this->orders
            ->keys()
            ->sumBy(fn (string $category) => $this->getTotalPriceWithDiscountByOrderCategory($category));
    }
}
