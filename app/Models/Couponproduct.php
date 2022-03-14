<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Couponproduct extends Model
{
    /**
     * Define Table Name
     */
    protected $table = 'coupon_product';

    public function product(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Product::class);
    }
}
