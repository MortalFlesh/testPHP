<?php

namespace AppBundle\Interview;

class Order
{
    /** @var string */
    private $orderCategory;

    /** @var float */
    private $price;

    /** @var string */
    private $itemName;

    /**
     * @param string $itemName
     * @param string $orderCategory
     * @param float $price
     */
    public function __construct($itemName, $orderCategory, $price)
    {
        $this->itemName = $itemName;
        $this->orderCategory = $orderCategory;
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getOrderCategory()
    {
        return $this->orderCategory;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getItemName()
    {
        return $this->itemName;
    }
}
