<?php

namespace App\Packages\Coupon\Validator\Rules;

use App\Packages\Coupon\Entity\Coupon;
use App\Packages\Coupon\Validator\RuleValidator;
use App\Packages\Coupon\Repositories\Contracts\CouponRepository;

class IsUsageLimited implements RuleValidator
{
    /**
     * @var Coupon
     */
    private $coupon;

    /**
     * @var CouponRepository
     */
    private $couponRepository;

    public function __construct(Coupon $coupon, CouponRepository $couponRepository)
    {
        $this->coupon = $coupon;
        $this->couponRepository = $couponRepository;
    }

    public function validate(): void
    {
        if (
            $this->coupon->getUsageLimit() > 0 &&
            $this->couponRepository->getTotalCouponThatHasBeenUsedInOrder($this->coupon->getId()) >= $this->coupon->getUsageLimit()
        ) {
            throw new \Exception("Oops, this coupon have maximum users to used it", 400);
        }
    }
}
