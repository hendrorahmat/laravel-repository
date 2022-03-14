<?php

namespace App\Http\Controllers\Api\V1;

use App\Packages\Coupon\Command\CouponCommand;
use App\Packages\Coupon\Repositories\Contracts\ProductRepository;
use App\Packages\Coupon\Repositories\Contracts\ProductVariationRepository;
use App\Packages\Coupon\Services\CouponService;
use App\Http\Controllers\Controller;
use App\Http\Requests\CalculateCouponRequest;

class CalculateCouponController extends Controller
{
    /**
     * @var CouponService
     */
    private $couponService;

    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * @var ProductVariationRepository
     */
    private $productVariationRepository;

    public function __construct(CouponService $couponService, ProductRepository $productRepository, ProductVariationRepository $productVariationRepository)
    {
        $this->couponService = $couponService;
        $this->productRepository = $productRepository;
        $this->productVariationRepository = $productVariationRepository;
    }

    public function store(CalculateCouponRequest $request, int $shopId)
    {
        $couponCommand = new CouponCommand();
        $couponCommand->setShopId($shopId);
        $couponCommand->setEmail($request->get('email'));
        $couponCommand->setPhoneNumber($request->get('phone_number'));
        $couponCommand->setCouponCode($request->get('coupon_code'));

        foreach ($request->get('products') as $product) {
            $productEntity = $this->productRepository->findById($product['product_id']);

            if (isset($product['variation_option_id'])) {
                $productVariation = $this->productVariationRepository->findVariationByProductIdAndProductOptionValueId(
                    $product['product_id'],
                    $product['variation_option_id']
                );

                // only set variation price if exists
                if ($productVariation && !empty($productVariation->variation_price)) {
                    $productEntity->setPrice($productVariation->variation_price);
                }
            }
            $productEntity->setQuantity($product['quantity']);
            $couponCommand->addProduct($productEntity);
        }

        return $this->couponService->applyCoupon($couponCommand);
    }
}
