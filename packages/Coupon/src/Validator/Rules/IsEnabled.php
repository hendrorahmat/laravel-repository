<?php

namespace App\Packages\Coupon\Validator\Rules;

use App\Packages\Coupon\Entity\Coupon;
use App\Packages\Coupon\Exceptions\CouponDeleted;
use App\Packages\Coupon\Validator\RuleValidator;
use Exception;

class IsEnabled implements RuleValidator
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
        if ($this->coupon->getIsEnabled() !== Coupon::COUPON_IS_ENABLED) {
            throw new Exception('coupon is not enabled', 400);
        }
    }
}
