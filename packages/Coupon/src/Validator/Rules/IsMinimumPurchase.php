<?php

namespace App\Packages\Coupon\Validator\Rules;

use Exception;
use App\Packages\Coupon\Entity\Coupon;
use App\Packages\Coupon\Entity\Product;
use App\Packages\Coupon\Validator\RuleValidator;

class IsMinimumPurchase implements RuleValidator
{
    /**
     * @var Coupon
     */
    private $coupon;

    /**
     * @var Product[]
     */
    private $products;

    public function __construct(Coupon $coupon, array $products)
    {
        $this->coupon = $coupon;
        $this->products = $products;
    }

    public function validate(): void
    {
        $total = 0;
        foreach ($this->products as $product) {
            $total += ($product->getPrice() + $product->getTax()) * $product->getQuantity();
        }

        if ($this->coupon->getMinimPurchase() > $total) {
            throw new Exception("Total Product doesn't meet the minimum coupon", 400);
        }
    }
}
