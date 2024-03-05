<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        abort_unless(
            Auth::user()->tokenCan('Producto:show'),
            403,
            'No tienes permisos para listar productos'
        );
        return new ProductResource($product);
    }
}
