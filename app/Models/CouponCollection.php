<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CouponCollection extends Model
{
    protected $primaryKey = 'coupon_collection_id';

    protected $table = 'coupon_collection';

    protected $fillable = [
        'coupon_collection_id',
        'coupon_id',
        'label_id',
        'created_at',
        'updated_at'
    ];

    public function label()
    {
        return $this->hasOne('App\Models\Label', 'label_id', 'label_id');
    }
}
