<?php

namespace App\Packages\Coupon\Repositories\Contracts;

use App\Packages\Coupon\Command\CouponCommand;
use App\Packages\Coupon\Entity\Coupon;

interface CouponRepository
{
    public function findCouponByCodeAndShopId(string $code, int $shopId): Coupon;

    public function getTotalCouponThatHasBeenUsedInOrder(int $couponId): int;

    public function getTotalCouponThatHasBeenUsedBySpecificCustomer(int $couponId, CouponCommand $couponCommand): int;
}
