<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductLabel extends Model
{
    protected $table = 'product_label';

    protected $primaryKey = 'product_label_id';

    protected $fillable = ['product_label_id', 'product_id', 'label_id'];


    public function label(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Label::class, 'label_id', 'label_id');
    }
}
