<?php

namespace App\Repositories\Eloquent;

use App\Models\Couponproduct;
use App\Models\Product as ModelsProduct;
use App\Models\Shop;
use App\Packages\Coupon\Entity\CouponProduct as EntityCouponProduct;
use App\Packages\Coupon\Entity\Product;
use App\Packages\Coupon\Repositories\Contracts\CouponProductRepository;

class EloquentCouponProductRepository implements CouponProductRepository
{
    /**
     * @var Couponproduct
     */
    private $model;

    public function __construct(Couponproduct $model)
    {
        $this->model = $model;
    }

    public function createProduct(ModelsProduct $productModel): Product
    {
        $taxAmount = 0;
        $price = $productModel->sale_enabled ? $productModel->sale_price : $productModel->price;

        $product = new Product;
        $product->setId($productModel->product_id);
        $product->setPrice($price);
        $product->setName($productModel->name);
        $product->setQuantity($productModel->quantity);
        $product->setTax($taxAmount);

        return $product;
    }

    /**
     * @param integer $couponId
     * @return CouponProduct[]
     */
    public function getProductsByCouponId(int $couponId): array
    {
        $couponProducts = [];
        $couponProductModels = $this->model->with('product')->where('coupon_id', $couponId)->get();

        foreach ($couponProductModels as $couponProductModel) {
            $couponProduct = new EntityCouponProduct;
            $product = $this->createProduct($couponProductModel->product);

            $couponProduct->setId($couponProductModel->coupon_product_id);
            $couponProduct->setProduct($product);
            $couponProducts[] = $couponProduct;
        }

        return $couponProducts;
    }
}
