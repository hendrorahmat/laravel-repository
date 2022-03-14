<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    /**
     * Define Column Name
     */
    protected $fillable = [
        "product_variation_id",
        "product_id",
        "product_option_id",
        "product_option_value_id",
        "variation_price",
        "variation_weight",
        "status"
    ];
    const STATUS_AVAILABLE = 1;
    const STATUS_UNAVAILABLE = 0;

}
