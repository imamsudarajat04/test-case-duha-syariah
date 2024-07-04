<?php

namespace App\Repositories\Eloquent;

use App\Models\Products;
use App\Repositories\Contracts\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    public function getAllProducts()
    {
        return Products::all();
    }
}