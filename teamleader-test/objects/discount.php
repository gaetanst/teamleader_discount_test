<?php
/**
 * Created by PhpStorm.
 * User: Gaetan
 * Date: 30/09/2017
 * Time: 11:06
 */

namespace Objects;


class Discount
{
    private $order;
    private $discount;
    private $totalAfterDiscount;

    /**
     * Discount constructor.
     * @param $order
     * @param $discount
     * @param $totalAfterDiscount
     */
    public function __construct($order, $discount, $totalAfterDiscount)
    {
        $this->order = $order;
        $this->discount = $discount;
        $this->totalAfterDiscount = $totalAfterDiscount;
    }

    /**
     * @return mixed
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @return mixed
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * @return mixed
     */
    public function getTotalAfterDiscount()
    {
        return $this->totalAfterDiscount;
    }

    public function __toString()
    {
        return json_encode(array(
            'order' => json_decode($this->order),
            'discount' => $this->discount,
            'total-after-discount' => $this->totalAfterDiscount
        ));
    }


}