<?php

namespace App\Packages\Coupon\Entity;

use App\Packages\Coupon\Entity\Product;
use App\Packages\Coupon\Entity\Collection;

class CouponProduct
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var Product
     */
    private $product;

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
     * Get the value of product
     *
     * @return Product
     */
    public function getProduct(): ?Product
    {
        return $this->product;
    }

    /**
     * Set the value of product
     *
     * @param Product $product
     *
     * @return self
     */
    public function setProduct(Product $product)
    {
        $this->product = $product;

        return $this;
    }
}
