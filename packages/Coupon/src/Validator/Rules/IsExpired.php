<?php

namespace App\Packages\Coupon\Validator\Rules;

use App\Packages\Coupon\Entity\Coupon;
use App\Packages\Coupon\Exceptions\CouponDeleted;
use App\Packages\Coupon\Validator\RuleValidator;
use Exception;

class IsExpired implements RuleValidator
{
    /**
     * @var Coupon
     */
    private $coupon;

    /**
     * @param Coupon $coupon
     */
    public function __construct(Coupon $coupon)
    {
        $this->coupon = $coupon;
    }

    public function validate(): void
    {
        if ($this->coupon->getDuration()->isExpired()) {
            throw new Exception('coupon has been expired', 400);
        }
    }
}
