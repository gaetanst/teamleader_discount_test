<?php
/**
 * Created by PhpStorm.
 * User: Gaetan
 * Date: 30/09/2017
 * Time: 11:03
 */

namespace Objects;


class Order
{
    private $id;
    private $customer;
    private $items;
    private $total;

    /**
     * Order constructor.
     * @param $id
     * @param $customer
     * @param $items
     * @param $total
     */
    public function __construct($id, $customer, $items, $total)
    {
        $this->id = $id;
        $this->customer = $customer;
        $this->items = $items;
        $this->total = $total;
    }

    /**
     * @return mixed
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @return mixed
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @return mixed
     */
    public function getTotal()
    {
        return $this->total;
    }

    public function __toString()
    {
        $itemsString = array();
        foreach ($this->items as $item)
            array_push($itemsString, json_decode($item));

        return json_encode(
            array(
                'id' => $this->id,
                'customer' => json_decode($this->customer),
                'items' => $itemsString,
                'total' => $this->total
            )
        );
    }


}