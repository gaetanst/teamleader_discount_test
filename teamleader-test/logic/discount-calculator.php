<?php
/**
 * Created by PhpStorm.
 * User: Gaetan
 * Date: 30/09/2017
 * Time: 11:06
 */

namespace Logic;

include(dirname(__DIR__).'/objects/discount.php');

use Objects\Discount;

class DiscountCalculator
{
    private $revenueDiscounts;
    private $quantityDiscounts;
    private $amountDiscounts;

    private $toolsCategoryID = 1;
    private $switchesCategoryID = 2;

    public function __construct() {
        $this->revenueDiscounts = array();
        $this->quantityDiscounts = array();
        $this->amountDiscounts = array();

        // Revenue Discounts ordered by revenue DESC
        array_push($this->revenueDiscounts, array(
           'revenue' => 1000,
           'discount' => 10
        ));

        // Quantity Discounts ordered by quantity DESC
        array_push($this->quantityDiscounts, array(
            'quantity' => 5,
            'discount' => 1
        ));

        // Category Amount Discounts ordered by Amount DESC
        array_push($this->amountDiscounts, array(
            'amount' => 2,
            'discount' => 20
        ));

    }

    public function getDiscountObject($order) {
        $discountValue = $this->getDiscountValue($order);

        return new Discount(
            $order,
            $discountValue,
            $order->getTotal() - $discountValue
        );
    }

    public function getDiscountValue($order) {
        $discount = 0;

        $discount = $this->checkTotalRevenueDiscount(
            $order->getCustomer()->getRevenue(),
            $order->getTotal()
        );
        $discount += $this->checkCategoryAmount($order->getItems());
        $discount += $this->checkProductQuantity($order->getItems());

        return $discount;
    }

    private function checkTotalRevenueDiscount($revenue, $totalOrderPrice) {
        foreach ($this->revenueDiscounts as $revenueDiscount) {
            if ($revenue > $revenueDiscount['revenue']) {
                return ($totalOrderPrice / 100) * $revenueDiscount['discount'];
            }
        }

        return 0;
    }

    private function checkProductQuantity($orderItems) {
        $discount = 0;

        foreach ($orderItems as $item) {
            if ($item->getProduct()->getCategory() == $this->switchesCategoryID) {
                $quantity = intval($item->getQuantity());
                foreach ($this->quantityDiscounts as $quantityDiscount) {
                    if ($quantity > $quantityDiscount['quantity']) {
                        $amountOfFreeItems = 0;
                        $amountOfFreeItems = floor($quantity / ($quantityDiscount['quantity'] + $quantityDiscount['discount'])) * $quantityDiscount['discount'];

                        $discount += $item->getUnitPrice() * $amountOfFreeItems;
                        break;
                    }
                }
            }
        }

        return $discount;
    }

    private function checkCategoryAmount($orderItems) {
        $toolsProducts = array();
        $discount = 0;

        foreach ($orderItems as $item) {
            if ($item->getProduct()->getCategory() === $this->toolsCategoryID)
                array_push($toolsProducts, $item);
        }

        foreach ($this->amountDiscounts as $amountDiscount) {
            if (count($toolsProducts) >= $amountDiscount['amount']) {
                // Sort array cheapest -> most expensive
                usort($toolsProducts, 'OrderItem::compareByPrice');

                // Take first item (cheapest product)
                $discount += ($toolsProducts[0]->getTotal() / 100) * $amountDiscount['discount'];
                break;
            }
        }

        return $discount;
    }


}