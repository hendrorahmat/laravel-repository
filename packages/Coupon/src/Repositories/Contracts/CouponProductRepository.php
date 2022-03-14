<?php

namespace App\Packages\Coupon\Repositories\Contracts;

use App\Packages\Coupon\Entity\CouponProduct;

interface CouponProductRepository
{
    /**
     * @param integer $couponId
     * @return CouponProduct[]
     */
    public function getProductsByCouponId(int $couponId): array;
}
