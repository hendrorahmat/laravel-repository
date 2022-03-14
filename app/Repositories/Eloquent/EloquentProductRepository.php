<?php

namespace App\Repositories\Eloquent;

use App\Packages\Coupon\Entity\Product;
use App\Packages\Coupon\Entity\Collection;
use App\Models\Product as ProductModel;
use App\Packages\Coupon\Repositories\Contracts\ProductRepository;

class EloquentProductRepository extends BaseRepository implements ProductRepository
{
    protected function __construct(ProductModel $model)
    {
        parent::__construct($model);
    }

    /**
     * @param integer $productId
     * @return Product
     */
    public function findById(int $productId): Product
    {
        $productModel = $this->model->with(['collection'])->where('product_id', $productId)->first();
        $taxAmount = 0;
        $price = $productModel->sale_enabled ? $productModel->sale_price : $productModel->price;
        $taxAmount = ($price * $taxAmount) / 100;

        $product = new Product;
        $product->setId($productModel->product_id);
        $product->setPrice($price);
        $product->setName($productModel->name);
        $product->setQuantity($productModel->quantity);
        $product->setTax($taxAmount);

        foreach ($productModel->collection->load('label') as $collection) {

            if (!is_null($collection->label)) {
                $entityCollection = new Collection;
                $entityCollection->setId($collection->label_id);
                $entityCollection->setName($collection->label->name);

                $product->addCollection($entityCollection);
            }
        }

        return $product;
    }
}
