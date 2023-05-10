<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Models\Product;
class LandingPageController extends Controller
{
    
    public function index()
    {

        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'products' => Product::query()
            ->filter([
                's' => request('s'),
                'category' => request('category'),
            ])
            ->paginate(40),
            'search' => [
                'keyword' => request()->s,
                'url' => route('products', array_filter([
                    'g' => request()->g,
                ])),
            ],
        ]);
    }
}
