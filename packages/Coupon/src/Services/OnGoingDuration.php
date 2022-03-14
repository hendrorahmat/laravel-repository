<?php

namespace App\Packages\Coupon\Services;

use App\Packages\Coupon\Services\Contracts\CouponDuration;

class OnGoingDuration extends CouponDuration
{
    public function isActive(): bool
    {
        return true;
    }

    public function isExpired(): bool
    {
        return false;
    }
}
