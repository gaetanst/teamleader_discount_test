<?php
/**
 * Created by PhpStorm.
 * User: Gaetan
 * Date: 30/09/2017
 * Time: 11:14
 */

namespace Objects;


class OrderItem
{
    private $product;
    private $quantity;
    private $unitPrice;
    private $total;

    /**
     * OrderItem constructor.
     * @param $product
     * @param $quantity
     * @param $unitPrice
     * @param $total
     */
    public function __construct($product, $quantity, $unitPrice, $total)
    {
        $this->product = $product;
        $this->quantity = $quantity;
        $this->unitPrice = $unitPrice;
        $this->total = $total;
    }

    /**
     * @return mixed
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param mixed $product
     */
    public function setProduct($product)
    {
        $this->product = $product;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return mixed
     */
    public function getUnitPrice()
    {
        return $this->unitPrice;
    }

    /**
     * @param mixed $unitPrice
     */
    public function setUnitPrice($unitPrice)
    {
        $this->unitPrice = $unitPrice;
    }

    /**
     * @return mixed
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param mixed $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }

    public function __toString()
    {
        return json_encode(
            array(
                'product' => json_decode($this->product),
                'quantity' => $this->quantity,
                'unit-price' => $this->unitPrice,
                'total' => $this->total
            )
        );
    }

    public function compareByPrice($a, $b) {
        if ($a->getUnitPrice() < $b->getUnitPrice()) {
            return -1;
        } elseif ($a->getUnitPrice() > $b->getUnitPrice()) {
            return 1;
        }

        return 0;
    }
}