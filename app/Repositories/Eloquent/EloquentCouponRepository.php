<?php

namespace App\Repositories\Eloquent;

use App\Models\Coupon as ModelsCoupon;
use App\Models\CustomerOrder;
use App\Packages\Coupon\Command\CouponCommand;
use App\Packages\Coupon\Entity\Coupon;
use App\Packages\Coupon\Repositories\Contracts\CouponRepository;
use App\Packages\Coupon\Services\FixCommission;
use App\Packages\Coupon\Services\OnGoingDuration;
use App\Packages\Coupon\Services\PercentCommission;
use App\Packages\Coupon\Services\SpecificDuration;
use Carbon\Carbon;

class EloquentCouponRepository implements CouponRepository
{
    /**
     * @var ModelsCoupon
     */
    private $model;

    public function __construct(ModelsCoupon $model)
    {
        $this->model = $model;
    }

    public function findCouponByCodeAndShopId(string $code, int $shopId): Coupon
    {
        $modelCoupon = $this->model->where('coupon_code', $code)
            ->where('shop_id', $shopId)
            ->where('coupon_status', Coupon::COUPON_STATUS_ACTIVE)
            ->first();

        if (is_null($modelCoupon)) {
            throw new \Exception("Coupon not found", 404);
        }

        if ($modelCoupon->coupon_type === ModelsCoupon::TYPE_PERCENTAGE) {
            $commission = new PercentCommission;
        } else {
            $commission = new FixCommission;
        }

        if ($modelCoupon->coupon_ongoing) {
            $duration = new OnGoingDuration;
        } else {
            $duration = new SpecificDuration;
            $duration->setStart(Carbon::parse($modelCoupon->coupon_start));
            $duration->setEnd(Carbon::parse($modelCoupon->coupon_expire)->endOfDay());
        }

        $coupon = new Coupon;
        $coupon->setCodeName($code);
        $coupon->setDuration($duration);
        $coupon->setId($modelCoupon->coupon_id);
        $coupon->setCouponCommission($commission);
        $coupon->setName($modelCoupon->coupon_name);
        $coupon->setStatus($modelCoupon->coupon_status);
        $coupon->setDiscount($modelCoupon->coupon_amount);
        $coupon->setIsEnabled($modelCoupon->coupon_enabled);
        $coupon->setUsageLimit($modelCoupon->coupon_quantity ?? 0);
        $coupon->setMinimPurchase($modelCoupon->coupon_minpurchase);
        $coupon->setCouponUsageType(intval($modelCoupon->coupon_usage_type));
        $coupon->setUsageLimitPerCustomer($modelCoupon->coupon_per_user_quantity);

        return $coupon;
    }

    public function getTotalCouponThatHasBeenUsedInOrder(int $couponId): int
    {
        return CustomerOrder::where('coupon_id', $couponId)
            ->whereIn('status', array(
                CustomerOrder::STATUS_PROCESSING,
                CustomerOrder::STATUS_SHIPPED,
                CustomerOrder::STATUS_PENDING,
                CustomerOrder::STATUS_PAID,
                CustomerOrder::STATUS_COMPLETED,
            ))
            ->count();
    }

    public function getTotalCouponThatHasBeenUsedBySpecificCustomer(int $couponId, CouponCommand $couponCommand): int
    {
        return CustomerOrder::where('coupon_id', $couponId)
            ->where('customer_email', $couponCommand->getEmail())
            ->where('customer_phone', $couponCommand->getPhoneNumber())
            ->whereIn('status', array(
                CustomerOrder::STATUS_PROCESSING,
                CustomerOrder::STATUS_SHIPPED,
                CustomerOrder::STATUS_PENDING,
                CustomerOrder::STATUS_PAID,
                CustomerOrder::STATUS_COMPLETED,
            ))
            ->count();
    }
}
