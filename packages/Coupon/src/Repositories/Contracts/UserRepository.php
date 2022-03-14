<?php

namespace App\Packages\Coupon\Repositories\Contracts;

use App\Packages\Coupon\Entity\User;

interface UserRepository
{
    public function findUserByPhoneNumberAndEmail(string $email, string $phoneNumber): User;
}
