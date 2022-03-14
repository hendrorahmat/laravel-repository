<?php

namespace App\Packages\Coupon\Validator\Rules;

use App\Packages\Coupon\Command\CouponCommand;
use App\Packages\Coupon\Entity\Coupon;
use App\Packages\Coupon\Entity\Product;
use App\Packages\Coupon\Validator\RuleValidator;
use Exception;

class IsEligible implements RuleValidator
{
    /**
     * @var Coupon
     */
    protected $coupon;

    /**
     * @var CouponCommand
     */
    protected $couponCommand;

    /**
     * @var Product[]
     */
    protected $products;

    public function __construct(
        Coupon $coupon,
        CouponCommand $couponCommand,
        array $products)
    {
        $this->coupon = $coupon;
        $this->couponCommand = $couponCommand;
        $this->products = $products;
    }

    public function validate(): void
    {
        if (empty($this->products)) {
            throw new Exception("Product is not eligible to use the coupon", 403);
        }
    }
}
