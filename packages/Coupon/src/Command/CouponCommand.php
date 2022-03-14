<?php

namespace App\Packages\Coupon\Command;

use App\Packages\Coupon\Entity\Product;

class CouponCommand
{
    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $phoneNumber;

    /**
     * @var Product[]
     */
    private $products;

    /**
     * @var string
     */
    private $couponCode;

    /**
     * @var int
     */
    private $shopId;

    /**
     * Get the value of email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @param string $email
     *
     * @return self
     */
    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of phoneNumber
     *
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    /**
     * Set the value of phoneNumber
     *
     * @param string $phoneNumber
     *
     * @return self
     */
    public function setPhoneNumber(string $phoneNumber): CouponCommand
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * Get the value of products
     *
     * @return Product[]
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    /**
     * Set the value of products
     *
     * @param Product $product
     *
     * @return self
     */
    public function addProduct(Product $product): CouponCommand
    {
        $this->products[] = $product;

        return $this;
    }

    /**
     * Get the value of couponCode
     *
     * @return string
     */
    public function getCouponCode(): string
    {
        return $this->couponCode;
    }

    /**
     * Set the value of couponCode
     *
     * @param string $couponCode
     *
     * @return self
     */
    public function setCouponCode(string $couponCode): CouponCommand
    {
        $this->couponCode = $couponCode;

        return $this;
    }

    /**
     * Get the value of shopId
     *
     * @return int
     */
    public function getShopId(): int
    {
        return $this->shopId;
    }

    /**
     * Set the value of shopId
     *
     * @param int $shopId
     *
     * @return self
     */
    public function setShopId(int $shopId): CouponCommand
    {
        $this->shopId = $shopId;

        return $this;
    }
}
