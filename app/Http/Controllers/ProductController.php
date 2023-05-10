<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

use App\Models\Product;
class ProductController extends Controller
{
 
    public function index()
    {
        $products = Product::all();

        return Inertia::render('Products/Index', [
            'data' => [
                'labels' => $products->pluck('product_name'),
                'datasets' => [
                    [
                        'label' => 'Products',
                        'backgroundColor' => '#ec4899',
                        'data' => $products->pluck('quantity')
                    ]
                ]
            ]
        ]);
    }

    public function update(Request $request, Product $product)
    {

       $product->update([
            'product_name' => $request->product_name,
            'price' => $request->price,
            'product_ingredients' => $request->product_ingredients,
            'quantity' => $request->quantity,
       ]);

       return Redirect::back();
    }
}
