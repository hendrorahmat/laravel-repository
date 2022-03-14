<?php

namespace Services\Contracts;

interface CouponApplied
{
    public function getTotalAmount(): float;
}
