<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Shop extends Model
{

    /**
     * Define Primary Key
     */
    protected $primaryKey = 'shop_id';


    /**
     * Define Table Name
     */
    protected $table = 'shop';

    /**
     * Filed that can be fillable
     *
     * @var array
     */
    protected $fillable = [
        'shop_id', 'fanpage_id', 'theshopid', 'token', 'app_flag', 'created_at', 'last_access', 'verified', 'test_id',
        'premium_plan', 'testdef', 'shop_key', 'is_hq'
    ];

    public function shopInfo(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne('App\Models\Shopinfo', 'shop_id', 'shop_id');
    }
}
