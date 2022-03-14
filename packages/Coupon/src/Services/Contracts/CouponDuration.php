<?php

namespace App\Packages\Coupon\Services\Contracts;

abstract class CouponDuration
{
    /**
     * @var \DateTime
     */
    private $start;

    /**
     * @var \DateTime
     */
    private $end;

    /**
     * @var \DateTime
     */
    private $expiredDate;

    abstract public function isActive(): bool;

    abstract public function isExpired(): bool;

    /**
     * Get the value of expiredDate
     *
     * @return \DateTime
     */
    public function getExpiredDate(): \DateTime
    {
        return $this->expiredDate;
    }

    /**
     * Set the value of expiredDate
     *
     * @param \DateTime $expiredDate
     *
     * @return self
     */
    public function setExpiredDate(\DateTime $expiredDate): self
    {
        $this->expiredDate = $expiredDate;

        return $this;
    }

    /**
     * Set the value of start
     */
    public function setStart(\DateTime $start): self
    {
        $this->start = $start;

        return $this;
    }

    /**
     * set the value of end
     */
    public function setEnd(\DateTime $end): self
    {
        $this->end = $end;

        return $this;
    }

    /**
     * Get the value of end
     */
    public function getEnd(): \DateTime
    {
        return $this->end;
    }

    /**
     * Get the value of start
     */
    public function getStart(): \DateTime
    {
        return $this->start;
    }
}
