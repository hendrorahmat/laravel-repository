<?php

namespace App\Packages\Coupon\Entity;

use App\Packages\Coupon\Entity\Product;
use App\Packages\Coupon\Entity\Collection;

class CouponCollection
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var Collection
     */
    private $collection;

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
     * Get the value of collection
     *
     * @return Collection
     */
    public function getCollection()
    {
        return $this->collection;
    }

    /**
     * Set the value of collection
     *
     * @param Collection $collection
     *
     * @return self
     */
    public function setCollection(Collection $collection)
    {
        $this->collection = $collection;

        return $this;
    }
}
