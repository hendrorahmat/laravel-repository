<?php

namespace App\Packages\Coupon\Services;

use ReflectionClass;
use App\Packages\Coupon\Entity\Coupon;
use App\Packages\Coupon\Entity\Product;
use App\Models\Coupon as ModelsCoupon;
use App\Packages\Coupon\Services\FixCommission;

class CouponCalculator
{
    /**
     * @var Product[]
     */
    private $products;

    /**
     * @var Coupon
     */
    private $coupon;

    /**
     * @param Product[] $products
     * @param Coupon $coupon
     */
    public function __construct(
        array $products,
        Coupon $coupon
    ) {
        $this->products = $products;
        $this->coupon = $coupon;
    }

    public function getTotalAmountProducts(): float
    {
        $totalAmountProduct = 0;
        foreach ($this->products as $product) {
            $amountProduct = $product->getTotalAmount();
            $totalAmountProduct += $amountProduct;
        }
        return $totalAmountProduct;
    }

    public function accumulate(): array
    {
        $response = [];
        $discount = $this->coupon->getDiscount();
        $totalAmountProduct = $this->getTotalAmountProducts();

        if (
            ($this->coupon->getCouponUsageType() === ModelsCoupon::USAGE_PER_PRODUCT_SELECTED_PRODUCTS ||
                $this->coupon->getCouponUsageType() === ModelsCoupon::USAGE_PER_PRODUCT_SELECTED_COLLECTION ||
                $this->coupon->getCouponUsageType() === ModelsCoupon::USAGE_PER_PRODUCT_ALL_PRODUCTS) &&
            $this->coupon->getCouponCommission() instanceof FixCommission
        ) {
            $discount = $discount * count($this->products);
        }

        $commission = $this->coupon->getCouponCommission();
        $commission->setAmount($totalAmountProduct);
        $commission->setDiscount($discount);
        $priceWithDiscount = $commission->calculate();

        $discountType = (new ReflectionClass($this->coupon->getCouponCommission()))->getShortName();
        $response['sub_total'] = ($totalAmountProduct <= 0 ? 0 : $totalAmountProduct);
        $response['sub_total_with_discount'] = ($priceWithDiscount <= 0 ? 0 : $priceWithDiscount);
        $response['total_discount'] = ($commission->getTotalDiscount() <= 0 ? 0 : $commission->getTotalDiscount());
        $response['discount_type'] = $discountType;

        return $response;
    }
}
