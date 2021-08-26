<?php

namespace App\Repositories;

use App\Repositories\Main\BaseRepository;
use App\Models\Product;

/**
 * Class ProductRepositoty.
 */
class ProductRepositoty extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Product::class;
    }
}