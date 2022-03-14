<?php

namespace App\Packages\Coupon\Services;

use App\Packages\Coupon\Services\Contracts\CouponDuration;

class SpecificDuration extends CouponDuration
{
    public function isActive(): bool
    {
        $time = time();

        if ($time >= strtotime($this->getStart()) && $time <= strtotime($this->getEnd())) {
            return true;
        }
        return false;
    }

    public function isExpired(): bool
    {
        $time = time();

        if (strtotime($this->getEnd()) < $time) {
            return true;
        }

        return false;
    }
}
