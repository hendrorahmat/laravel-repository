<?php

namespace App\Packages\Coupon\Repositories\Contracts;

use App\Packages\Coupon\Entity\Product;

interface ProductRepository
{
    /**
     * @param integer $productId
     * @return Product
     */
    public function findById(int $productId): Product;
}
