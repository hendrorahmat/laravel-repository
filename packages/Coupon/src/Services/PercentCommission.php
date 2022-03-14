<?php

namespace App\Packages\Coupon\Services;

use App\Packages\Coupon\Services\Contracts\CouponCommission;

class PercentCommission implements CouponCommission
{
    /**
     * @var float
     */
    private $discount;

    /**
     * @var float
     */
    private $amount;

    public function calculate(): float
    {
        return $this->getAmount() - $this->getTotalDiscount();
    }

    public function getTotalDiscount(): float
    {
        return  ($this->getAmount() * $this->getDiscount()) / 100;
    }

    /**
     * Get the value of discount
     *
     * @return float
     */
    public function getDiscount(): float
    {
        return $this->discount;
    }

    /**
     * Set the value of discount
     *
     * @param float $discount
     *
     * @return self
     */
    public function setDiscount(float $discount): self
    {
        $this->discount = $discount;

        return $this;
    }

    /**
     * Get the value of amount
     *
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * Set the value of amount
     *
     * @param float $amount
     *
     * @return self
     */
    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }
}
