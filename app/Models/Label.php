<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    protected $table = 'label';

    protected $primaryKey = 'label_id';

    protected $fillable = ['label_id', 'shop_id', 'name', 'slug', 'description'];

    public function productLabel(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProductLabel::class, 'label_id', 'label_id');
    }
}
