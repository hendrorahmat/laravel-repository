<?php

namespace App\Packages\Coupon\Validator\Rules;

use App\Packages\Coupon\Entity\Coupon;
use App\Packages\Coupon\Command\CouponCommand;
use App\Packages\Coupon\Validator\RuleValidator;
use App\Packages\Coupon\Repositories\Contracts\CouponRepository;

class IsUsageLimitedPerCustomer implements RuleValidator
{
    /**
     * @var Coupon
     */
    private $coupon;

    /**
     * @var CouponRepository
     */
    private $couponRepository;

    /**
     * @var CouponCommand
     */
    private $couponCommand;

    public function __construct(
        Coupon $coupon,
        CouponRepository $couponRepository,
        CouponCommand $couponCommand
    ) {
        $this->coupon = $coupon;
        $this->couponCommand = $couponCommand;
        $this->couponRepository = $couponRepository;
    }

    public function validate(): void
    {
        if (
            $this->coupon->getUsageLimitPerCustomer() > 0 &&
            $this->couponRepository->getTotalCouponThatHasBeenUsedBySpecificCustomer($this->coupon->getId(), $this->couponCommand) >= $this->coupon->getUsageLimitPerCustomer()
        ) {
            throw new \Exception("Oops, you have exceeded the number of use for this coupon", 400);
        }
    }
}
