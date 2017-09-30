<?php
/**
 * Created by PhpStorm.
 * User: Gaetan
 * Date: 30/09/2017
 * Time: 11:05
 */
namespace Logic;

include(dirname(__DIR__).'/data/data.php');
include(dirname(__DIR__).'/logic/discount-calculator.php');
include(dirname(__DIR__).'/objects/order.php');
include(dirname(__DIR__).'/objects/order-item.php');

use Data\DataImplementation;
use Objects\Order;
use Objects\OrderItem;

class LogicImplementation
{
    private $dataObject;
    private $discountCalculatorObject;
    public $orderObject;

    /**
     * LogicImplementation constructor.
     */
    public function __construct()
    {
        $this->dataObject = new DataImplementation();
        $this->discountCalculatorObject = new DiscountCalculator();
    }

    public function checkForDiscounts($orderJSONObj) {
        $this->convertOrderJSONToObject($orderJSONObj);


        return $this->discountCalculatorObject->getDiscountObject($this->orderObject);
    }

    private function convertOrderJSONToObject($json) {
        $this->orderObject = new Order(
            $json['id'],
            $this->getCustomerByID($json['customer-id']),
            $this->getOrderItemsObjects($json['items']),
            $json['total']
        );
    }

    private function getCustomerByID($customerId) {
        foreach ($this->dataObject->getCustomers() as $customer) {
            if ($customer->getId() === $customerId) {
                return $customer;
            }
        }

        return null;
    }

    private function getProductByID($productId) {
        foreach ($this->dataObject->getProducts() as $product) {
            if ($product->getId() === $productId) {
                return $product;
            }
        }

        return null;
    }

    private function getOrderItemsObjects($orderItemsJSONObj) {
        $orderItems = array();

        foreach ($orderItemsJSONObj as $orderItemJson) {
            array_push(
                $orderItems,
                new OrderItem(
                    $this->getProductByID($orderItemJson['product-id']),
                    $orderItemJson['quantity'],
                    $orderItemJson['unit-price'],
                    $orderItemJson['total']
                )
            );
        }

        return $orderItems;
    }
}