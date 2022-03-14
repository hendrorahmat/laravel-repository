<?php

namespace App\Repositories\Eloquent;

use App\Models\CouponCollection;
use App\Packages\Coupon\Entity\Collection;
use App\Packages\Coupon\Entity\CouponCollection as EntityCouponCollections;
use App\Packages\Coupon\Repositories\Contracts\CouponCollectionRepository;

class EloquentCouponCollectionRepository implements CouponCollectionRepository
{
    /**
     * @var CouponCollection
     */
    private $model;

    public function __construct(CouponCollection $model)
    {
        $this->model = $model;
    }

    /**
     * @param int $couponId
     * @return EntityCouponCollections[]
     */
    public function getCollectionsByCouponid(int $couponId): array
    {
        $datas = $this->model->with('label')->where('coupon_id', $couponId)->get();
        $couponCollections = [];

        foreach ($datas as $data) {
            $couponCollection = new EntityCouponCollections;

            $collection = new Collection;
            $collection->setId($data->label->label_id);
            $collection->setName($data->label->name);

            $couponCollection->setId($data->coupon_collection_id);
            $couponCollection->setCollection($collection);
            $couponCollections[] = $couponCollection;
        }

        return $couponCollections;
    }
}
