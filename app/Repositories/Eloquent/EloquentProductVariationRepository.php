<?php

namespace App\Repositories\Eloquent;

use App\Models\ProductVariation;
use App\Packages\Coupon\Repositories\Contracts\ProductVariationRepository;

class EloquentProductVariationRepository extends BaseRepository implements ProductVariationRepository
{
    public function __construct(ProductVariation $model)
    {
        parent::__construct($model);
    }

    /**
     * @param integer $productId
     * @param integer $productOptionValueId
     * @return ProductVariation|null
     */
    public function findVariationByProductIdAndProductOptionValueId(int $productId, int $productOptionValueId): ?ProductVariation
    {
        return ProductVariation::where('product_id', $productId)->where('product_option_value_id', $productOptionValueId)->first();
    }
}
