<?php

namespace App\Packages\Coupon\Repositories\Contracts;

use App\Packages\Coupon\Entity\CouponCollection;

interface CouponCollectionRepository
{
    /**
     * @param integer $couponId
     * @return CouponCollection[]
     */
    public function getCollectionsByCouponid(int $couponId): array;
}
