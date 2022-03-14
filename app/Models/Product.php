<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        "shop_id",
        "tax_id",
        "quantity",
        "model",
        "image",
        "price",
        "price_by_variation",
        "status",
        "sale_price",
        "name",
        "description",
        "description_format",
        "slug",
        "max_purchase_per_trans",
    ];

    protected $dates = [
        'created_at',
        'deleted_at'
    ];

    public function collection(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\ProductLabel', 'product_id', 'product_id');
    }
}
