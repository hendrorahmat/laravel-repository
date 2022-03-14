<?php

namespace App\Packages\Coupon\Validator\Rules;

use App\Packages\Coupon\Entity\Coupon;
use App\Packages\Coupon\Exceptions\CouponDeleted;
use App\Packages\Coupon\Validator\RuleValidator;

class IsNotDeleted implements RuleValidator
{
    /**
     * @var Coupon
     */
    private $coupon;

    public function __construct(Coupon $coupon)
    {
        $this->coupon = $coupon;
    }

    public function validate(): void
    {
        if ($this->coupon->getStatus() === Coupon::COUPON_STATUS_DELETED) {
            throw new CouponDeleted('coupon is already deleted', 400);
        }
    }
}
