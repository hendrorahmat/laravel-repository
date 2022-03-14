<?php

namespace App\Packages\Coupon\Repositories\Contracts;

use App\Models\ProductVariation;

interface ProductVariationRepository
{
    /**
     * @param integer $productId
     * @param integer $productOptionValueId
     * @return ProductVariation|null
     */
    public function findVariationByProductIdAndProductOptionValueId(int $productId, int $productOptionValueId): ?ProductVariation;
}
