<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerOrder extends Model
{
    const STATUS_INCOMPLETE = 0;
    const STATUS_PROCESSING = 1;
    const STATUS_SHIPPED = 2;
    const STATUS_REFUNDED = 3;
    const STATUS_PENDING = 4;
    const STATUS_PAID = 5;
    const STATUS_CANCELLED = 6;
    const STATUS_COMPLETED = 7;
    const STATUS_REQUEST_REFUND = 8;

    protected $primaryKey = 'order_id';
    protected $table = 'customer_order';

    protected $fillable = [
        "shop_id",
        "user_id",
        "coupon_id",
        "coupon_code",
        "status",
        "sub_total",
        "total_shipping",
        "total_tax",
        "total_price",
        "total_coupon",
        "total_weight",
        "tracking_code",
        "restocked",
        "discount",
        "external",
        "shipping_date",
        "conversion_rate",
        "notes",
        "customer_email",
        "customer_phone"
    ];
}
