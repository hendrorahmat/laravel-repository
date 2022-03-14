<?php

namespace App\Packages\Coupon\Entity;

use App\Packages\Coupon\Services\Contracts\CouponDuration;
use App\Packages\Coupon\Services\Contracts\CouponCommission;

class Coupon
{
    const COUPON_APPLY_TO_PER_ORDER = 0;
    const COUPON_APPLY_TO_PER_PRODUCT = 1;

    const COUPON_ELIGIBLE_TO_PRODUCTS = 1;
    const COUPON_ELIGIBLE_TO_COLLECTIONS = 2;

    const COUPON_STATUS_DELETED = 2;
    const COUPON_STATUS_ACTIVE = 1;

    const COUPON_USAGE_INFINITY = 0;
    const COUPON_USAGE_PER_CUSTOMER_INFINITY = 0;

    const COUPON_IS_ENABLED = 1;

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $codeName;

    /**
     * @var int
     */
    private $isEnabled;

    /**
     * @var float
     */
    private $minimPurchase;

    /**
     * to specify discount is percent or fix
     *
     * @var CouponCommission
     */
    private $couponCommission;

    /**
     * To specify the coupon code being used by customers
     *
     * @var int
     */
    private $usageLimit;

    /**
     * Specify the usage limit of this coupon for each customer
     *
     * @var int
     */
    private $usageLimitPerCustomer;

    /**
     * to Specify this coupon status active or deleted
     *
     * @var int
     */
    private $status;

    /**
     * to specify this coupon on going or specific duration
     *
     * @var CouponDuration
     */
    private $duration;

    /**
     * to specify per product or order
     *
     * @var int
     */
    private $applyTo;

    /**
     * to specify per collections or products 0 means per total order
     *
     * @var int
     */
    private $eligibleTo = 0;

    /**
     * value for discount
     *
     * @var float
     */
    private $discount;

    /**
     * value for discount
     *
     * @var int
     */
    private $couponUsageType;

    /**
     * Get the value of id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param int $id
     *
     * @return self
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of codeName
     */
    public function getCodeName()
    {
        return $this->codeName;
    }

    /**
     * Set the value of codeName
     *
     * @return self
     */
    public function setCodeName($codeName): self
    {
        $this->codeName = $codeName;

        return $this;
    }

    /**
     * Get the value of isEnabled
     *
     * @return int
     */
    public function getIsEnabled(): int
    {
        return $this->isEnabled;
    }

    /**
     * Set the value of isEnabled
     *
     * @param int $isEnabled
     *
     * @return self
     */
    public function setIsEnabled(int $isEnabled): self
    {
        $this->isEnabled = $isEnabled;

        return $this;
    }

    /**
     * Get the value of minimPurchase
     *
     * @return float
     */
    public function getMinimPurchase()
    {
        return $this->minimPurchase;
    }

    /**
     * Set the value of minimPurchase
     *
     * @param float $minimPurchase
     *
     * @return self
     */
    public function setMinimPurchase(float $minimPurchase)
    {
        $this->minimPurchase = $minimPurchase;

        return $this;
    }

    /**
     * Get the value of usageLimitPerCustomer
     *
     * @return int
     */
    public function getUsageLimitPerCustomer(): int
    {
        return $this->usageLimitPerCustomer;
    }

    /**
     * Set the value of usageLimitPerCustomer
     *
     * @param int $usageLimitPerCustomer
     *
     * @return self
     */
    public function setUsageLimitPerCustomer(int $usageLimitPerCustomer): self
    {
        $this->usageLimitPerCustomer = $usageLimitPerCustomer;

        return $this;
    }

    /**
     * Get the value of usageLimit
     *
     * @return int
     */
    public function getUsageLimit()
    {
        return $this->usageLimit;
    }

    /**
     * Set the value of usageLimit
     *
     * @param int $usageLimit
     *
     * @return self
     */
    public function setUsageLimit(int $usageLimit)
    {
        $this->usageLimit = $usageLimit;

        return $this;
    }

    /**
     * Get the value of name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get to specify this coupon on going or specific duration
     *
     * @return CouponDuration
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set to specify this coupon on going or specific duration
     *
     * @param CouponDuration $duration  to specify this coupon on going or specific duration
     *
     * @return self
     */
    public function setDuration(CouponDuration $duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get to specify per product or order
     *
     * @return int
     */
    public function getApplyTo()
    {
        return $this->applyTo;
    }

    /**
     * Set to specify per product or order
     *
     * @param int $applyTo  to specify per product or order
     *
     * @return self
     */
    public function setApplyTo(int $applyTo)
    {
        $this->applyTo = $applyTo;

        return $this;
    }

    /**
     * Get to specify per collections or products
     *
     * @return int
     */
    public function getEligibleTo()
    {
        return $this->eligibleTo;
    }

    /**
     * Set to specify per collections or products
     *
     * @param int $eligibleTo  to specify per collections or products
     *
     * @return self
     */
    public function setEligibleTo(int $eligibleTo)
    {
        $this->eligibleTo = $eligibleTo;

        return $this;
    }

    /**
     * Get to Specify this coupon status active or deleted
     *
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * Set to Specify this coupon status active or deleted
     *
     * @param int $status  to Specify this coupon status active or deleted
     *
     * @return self
     */
    public function setStatus(int $status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get to specify discount is percent or fix
     *
     * @return CouponCommission
     */
    public function getCouponCommission()
    {
        return $this->couponCommission;
    }

    /**
     * Set to specify discount is percent or fix
     *
     * @param CouponCommission $couponCommission  to specify discount is percent or fix
     *
     * @return self
     */
    public function setCouponCommission(CouponCommission $couponCommission)
    {
        $this->couponCommission = $couponCommission;

        return $this;
    }

    /**
     * Get value for discount
     *
     * @return float
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * Set value for discount
     *
     * @param float $discount  value for discount
     *
     * @return self
     */
    public function setDiscount(float $discount)
    {
        $this->discount = $discount;

        return $this;
    }

    /**
     * Get value for discount
     *
     * @return int
     */
    public function getCouponUsageType()
    {
        return $this->couponUsageType;
    }

    /**
     * Set value for discount
     *
     * @param int $couponUsageType  value for discount
     *
     * @return self
     */
    public function setCouponUsageType(int $couponUsageType)
    {
        $this->couponUsageType = $couponUsageType;

        return $this;
    }
}
