<?php
/**
 * Created by PhpStorm.
 * User: Gaetan
 * Date: 30/09/2017
 * Time: 11:05
 */

namespace Data;

include(dirname(__DIR__).'/objects/customer.php');
include(dirname(__DIR__).'/objects/product.php');

use Objects\Customer;
use Objects\Product;

class DataImplementation
{
    private $products;
    private $customers;

    /**
     * DataImplementation constructor.
     */
    public function __construct()
    {
        $this->importCustomers();
        $this->importProducts();
    }

    private function importProducts() {
        $json = json_decode(file_get_contents(dirname(__FILE__).'/json/products.json'), true);
        $this->products = array();

        foreach ($json as $jsonItem) {
            array_push(
                $this->products,
                new Product(
                    $jsonItem['id'],
                    $jsonItem['description'],
                    $jsonItem['category'],
                    $jsonItem['price']
                )
            );
        }
    }
    private function importCustomers() {
        $json = json_decode(file_get_contents(dirname(__FILE__).'/json/customers.json'), true);
        $this->customers = array();

        foreach ($json as $jsonItem) {
            array_push(
                $this->customers,
                new Customer(
                    $jsonItem['id'],
                    $jsonItem['name'],
                    $jsonItem['since'],
                    $jsonItem['revenue']
                )
            );
        }
    }

    /**
     * @return mixed
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @return mixed
     */
    public function getCustomers()
    {
        return $this->customers;
    }
}