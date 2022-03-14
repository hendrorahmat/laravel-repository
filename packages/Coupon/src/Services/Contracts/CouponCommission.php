<?php

namespace App\Packages\Coupon\Services\Contracts;

interface CouponCommission
{
    public function setDiscount(float $value);

    public function getDiscount(): float;

    public function setAmount(float $amount);

    public function getAmount(): float;

    public function calculate(): float;

    /** this function to get total discount only */
    public function getTotalDiscount(): float;
}
