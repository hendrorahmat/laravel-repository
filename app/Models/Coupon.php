<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{

    /**
     * Define Primary Key
     */
    protected $primaryKey = 'coupon_id';


    /**
     * Define Table Name
     */
    protected $table = 'coupon';

    const TYPE_FIXED = 1;
    const TYPE_PERCENTAGE = 2;

    const USAGE_PER_ORDER = 0;
    const USAGE_PER_PRODUCT = 1;

    const USAGE_PER_ORDER_ALL_PRODUCTS = 0;
    const USAGE_PER_PRODUCT_SELECTED_PRODUCTS = 1;
    const USAGE_PER_PRODUCT_ALL_PRODUCTS = 2;
    const USAGE_PER_ORDER_SELECTED_PRODUCTS = 3;
    const USAGE_PER_ORDER_SELECTED_COLLECTION = 4;
    const USAGE_PER_PRODUCT_SELECTED_COLLECTION = 5;

    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 2;

    const COUPON_BANNER_DISPLAYED = 1;
    const COUPON_BANNER_UNDISPLAY = 0;

    protected $casts = [
        'coupon_amount' => 'double',
        'coupon_minpurchase' => 'double',
        'coupon_quantity' => 'integer',
        'coupon_applyto' => 'integer',
        'coupon_type' => 'integer',
        'coupon_per_user_quantity' => 'integer',
    ];

    protected $fillable = [
        'shop_id',
        'coupon_name',
        'coupon_amount',
        'coupon_minpurchase',
        'coupon_quantity',
        'coupon_applyto',
        'coupon_type',
        'coupon_expire',
        'coupon_enabled',
        'coupon_code',
        'coupon_used',
        'coupon_ongoing',
        'coupon_start',
        'coupon_status',
        'coupon_usage_type',
        'coupon_banner',
    ];
}
