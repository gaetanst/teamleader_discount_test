<?php
/**
 * Created by PhpStorm.
 * User: Gaetan
 * Date: 30/09/2017
 * Time: 11:01
 */

namespace Objects;

class Customer
{
    private $id;
    private $name;
    private $since;
    private $revenue;

    /**
     * Customer constructor.
     * @param $id
     * @param $name
     * @param $since
     * @param $revenue
     */
    public function __construct($id, $name, $since, $revenue)
    {
        $this->id = $id;
        $this->name = $name;
        $this->since = $since;
        $this->revenue = $revenue;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getSince()
    {
        return $this->since;
    }

    /**
     * @param mixed $since
     */
    public function setSince($since)
    {
        $this->since = $since;
    }

    /**
     * @return mixed
     */
    public function getRevenue()
    {
        return $this->revenue;
    }

    /**
     * @param mixed $revenue
     */
    public function setRevenue($revenue)
    {
        $this->revenue = $revenue;
    }

    public function __toString()
    {
        return json_encode(
            array(
                'id' => $this->id,
                'name' => $this->name,
                'since' => $this->since,
                'revenue' => $this->revenue
            )
        );
    }


}