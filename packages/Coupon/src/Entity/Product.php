<?php

namespace App\Packages\Coupon\Entity;

class Product
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $quantity;

    /**
     * @var float
     */
    private $price;

    /**
     * @var float
     */
    private $tax = 0;

    /**
     * @var Collection[]
     */
    private $collections =  [];

    /**
     * Get the value of id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param int $id
     *
     * @return self
     */
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of quantity
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set the value of quantity
     *
     * @param int $quantity
     *
     * @return self
     */
    public function setQuantity(int $quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get the value of price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @param float $price
     *
     * @return self
     */
    public function setPrice(float $price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of tax
     *
     * @return float
     */
    public function getTax()
    {
        return $this->tax;
    }

    /**
     * Set the value of tax
     *
     * @param float $tax
     *
     * @return self
     */
    public function setTax(float $tax)
    {
        $this->tax = $tax;

        return $this;
    }

    /**
     * Get the value of collections
     *
     * @return Collection[]
     */
    public function getCollections()
    {
        return $this->collections;
    }

    /**
     * Set the value of collections
     *
     * @param Collection[] $collections
     *
     * @return self
     */
    public function addCollection(Collection $collection): self
    {
        $this->collections[] = $collection;

        return $this;
    }

    public function getTotalAmount(): float
    {
	    return ($this->getPrice() + $this->getTax()) * $this->getQuantity();
    }
}
