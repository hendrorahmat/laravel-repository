<?php

namespace App\Packages\Coupon\Services;

use App\Models\Coupon as ModelsCoupon;
use App\Packages\Coupon\Entity\Coupon;
use App\Packages\Coupon\Entity\CouponProduct;
use App\Packages\Coupon\Command\CouponCommand;
use App\Packages\Coupon\Entity\CouponCollection;
use App\Packages\Coupon\Entity\Product;
use App\Packages\Coupon\Validator\CouponValidator;
use Exception;
use App\Packages\Coupon\Validator\Rules\{
    IsExpired,
    IsEnabled,
    IsActive,
    IsEligible,
    IsMinimumPurchase,
    IsNotDeleted,
    IsUsageLimited,
    IsUsageLimitedPerCustomer
};
use App\Packages\Coupon\Repositories\Contracts\{
    CouponRepository,
    ProductRepository,
    CouponProductRepository,
    CouponCollectionRepository
};

class CouponService
{
    /**
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     * @var CouponProductRepository
     */
    protected $couponProductRepository;

    /**
     * @var CouponCollectionRepository
     */
    protected $couponCollectionRepository;

    /**
     * @var CouponCollection[]
     */
    public $couponCollections;

    /**
     * @var CouponProduct[]
     */
    public $couponProducts;

    /**
     * @var CouponRepository
     */
    protected $couponRepository;

    public function __construct(
        CouponCollectionRepository $couponCollectionRepository,
        CouponProductRepository $couponProductRepository,
        CouponRepository $couponRepository
    ) {
        $this->couponRepository = $couponRepository;
        $this->couponProductRepository = $couponProductRepository;
        $this->couponCollectionRepository = $couponCollectionRepository;
    }

    /**
     * @param Coupon $coupon
     * @return CouponProduct[]
     */
    public function getCouponProducts(Coupon $coupon): array
    {
        $this->couponProducts = $this->couponProductRepository->getProductsByCouponId($coupon->getId());
        return $this->couponProducts;
    }

    /**
     * @param Coupon $coupon
     * @return CouponCollection[]
     */
    public function getCouponCollections(Coupon $coupon): array
    {
        $this->couponCollections = $this->couponCollectionRepository->getCollectionsByCouponid($coupon->getId());
        return $this->couponCollections;
    }

    /**
     * @param CouponCommand $couponCommand
     * @param CouponCollection[] $couponCollections
     * @return Product[]
     */
    public function getSelectedProductByCollections(CouponCommand $couponCommand, array $couponCollections): array
    {
        $selectedProducts = [];

        foreach ($couponCommand->getProducts() as $product) {
            foreach ($product->getCollections() as $productCommandCollection) {
                $isExistsCollection = false;
                foreach ($couponCollections as $couponCollection) {
                    if (
                        $productCommandCollection->getId() === $couponCollection->getCollection()->getId()
                    ) {
                        $isExistsCollection = true;
                        break;
                    }
                }

                if ($isExistsCollection) {
                    $selectedProducts[] = $product;
                    break;
                }
            }
        }
        return $selectedProducts;
    }

    /**
     * @param CouponCommand $couponCommand
     * @param CouponProduct[] $couponProducts
     * @return Product[]
     */
    public function getSelectedProducts(CouponCommand $couponCommand, array $couponProducts): array
    {
        $selectedProducts = [];
        foreach ($couponProducts as $couponProduct) {
            foreach ($couponCommand->getProducts() as $commandProduct) {
                if ($commandProduct->getId() === $couponProduct->getProduct()->getId()) {
                    $selectedProducts[$commandProduct->getId()] = $commandProduct;
                }
            }
        }
        return $selectedProducts;
    }

	/**
	 * @param Coupon $coupon
	 * @param Product[] $products
	 * @return Product[]
	 * @throws Exception
	 */
	public function getProductThatOnlyHaveMinimumPurchase(Coupon $coupon, array $products): array
	{
		if (
			$coupon->getCouponUsageType() === ModelsCoupon::USAGE_PER_PRODUCT_SELECTED_PRODUCTS ||
			$coupon->getCouponUsageType() === ModelsCoupon::USAGE_PER_PRODUCT_SELECTED_COLLECTION ||
			$coupon->getCouponUsageType() === ModelsCoupon::USAGE_PER_PRODUCT_ALL_PRODUCTS
		) {
			$productHaveMinimumPurchase = [];
			foreach ($products as $product) {
				if ($product->getTotalAmount() >= $coupon->getMinimPurchase()) {
					$productHaveMinimumPurchase[] = $product;
				}
			}

			if (empty($productHaveMinimumPurchase)) {
				throw new Exception('There is no one product has minimum purchase', 400);
			}
			return $productHaveMinimumPurchase;
		}
		return $products;
    }

	/**
	 * @param CouponCommand $couponCommand
	 * @param Coupon $coupon
	 * @return Product[]
	 * @throws Exception
	 */
    public function getSelectedDataProducts(CouponCommand $couponCommand, Coupon $coupon): array
    {
    	$products = [];

        if (
            $coupon->getCouponUsageType() === ModelsCoupon::USAGE_PER_ORDER_ALL_PRODUCTS ||
            $coupon->getCouponUsageType() === ModelsCoupon::USAGE_PER_PRODUCT_ALL_PRODUCTS
        ) {
            $products = $couponCommand->getProducts();
        }

        if (
            $coupon->getCouponUsageType() === ModelsCoupon::USAGE_PER_ORDER_SELECTED_COLLECTION ||
            $coupon->getCouponUsageType() === ModelsCoupon::USAGE_PER_PRODUCT_SELECTED_COLLECTION
        ) {
            $couponCollections = $this->getCouponCollections($coupon);
            $products = $this->getSelectedProductByCollections($couponCommand, $couponCollections);
        }

        if (
            $coupon->getCouponUsageType() === ModelsCoupon::USAGE_PER_ORDER_SELECTED_PRODUCTS ||
            $coupon->getCouponUsageType() === ModelsCoupon::USAGE_PER_PRODUCT_SELECTED_PRODUCTS
        ) {
            $couponProducts = $this->getCouponProducts($coupon);
            $products = $this->getSelectedProducts($couponCommand, $couponProducts);
        }

        return $this->getProductThatOnlyHaveMinimumPurchase($coupon, $products);
    }

    /**
     * @param CouponCommand $couponCommand
     * @throws Exception
     * @return array
     */
    public function applyCoupon(CouponCommand $couponCommand): array
    {
        $coupon = $this->couponRepository->findCouponByCodeAndShopId($couponCommand->getCouponCode(), $couponCommand->getShopId());
        $couponValidator = new CouponValidator;
        $selectedProducts = $this->getSelectedDataProducts($couponCommand, $coupon);

        $couponValidator->addRules(
            new IsActive($coupon),
            new IsEnabled($coupon),
            new IsExpired($coupon),
            new IsNotDeleted($coupon),
            new IsEligible($coupon, $couponCommand, $selectedProducts),
            new IsMinimumPurchase($coupon, $selectedProducts),
            new IsUsageLimited($coupon, $this->couponRepository),
            new IsUsageLimitedPerCustomer($coupon, $this->couponRepository, $couponCommand)
        );
        $couponValidator->validate();

        $couponCalculator = new CouponCalculator(
            $selectedProducts,
            $coupon
        );
        $response = $couponCalculator->accumulate();
        $response['status'] = true;

        return $response;
    }
}
