<?php
/**
 * Created by PhpStorm.
 * User: Gaetan
 * Date: 30/09/2017
 * Time: 11:04
 */

namespace Objects;


class Product
{
    private $id;
    private $description;
    private $category;
    private $price;

    function __construct($id, $description, $category, $price) {
        $this->id = $id;
        $this->description = $description;
        $this->category = $category;
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function __toString()
    {
        return json_encode(
            array(
                'id' => $this->id,
                'description' => $this->description,
                'category' => $this->category,
                'price' => $this->price
            )
        );
    }


}