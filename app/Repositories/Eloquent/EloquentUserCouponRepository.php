<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Packages\Coupon\Entity\User as UserCoupon;
use App\Packages\Coupon\Repositories\Contracts\UserRepository;

class EloquentUserCouponRepository extends BaseRepository implements UserRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function findUserByPhoneNumberAndEmail(string $email, string $phoneNumber): UserCoupon
    {
        $user = $this->model->where('email', $email)->where('phone', $phoneNumber)->first();

        $userCoupon = new UserCoupon;
        $userCoupon->setId($user->user_id);
        $userCoupon->setPhoneNumber($user->phone);
        $userCoupon->setEmail($user->email);

        return $userCoupon;
    }
}
