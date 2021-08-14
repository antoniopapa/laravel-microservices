<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function frontend()
    {
        if ($products = \Cache::get('products_frontend')) {
            return $products;
        }

        $products = Product::all();

        \Cache::set('products_frontend', $products, 30 * 60); //30 min

        return $products;
    }

    public function backend(Request $request)
    {
        $page = $request->input('page', 1);

        /** @var Collection $products */
        $products = \Cache::remember('products_backend', 30 * 60, fn() => Product::all());

        if ($s = $request->input('s')) {
            $products = $products
                ->filter(
                    fn(Product $product) => Str::contains($product->title, $s) || Str::contains($product->description, $s)
                );
        }

        $total = $products->count();

        if ($sort = $request->input('sort')) {
            if ($sort === 'asc') {
                $products = $products->sortBy([
                    fn($a, $b) => $a['price'] <=> $b['price']
                ]);
            } else if ($sort === 'desc') {
                $products = $products->sortBy([
                    fn($a, $b) => $b['price'] <=> $a['price']
                ]);
            }
        }

        return [
            'data' => $products->forPage($page, 9)->values(),
            'meta' => [
                'total' => $total,
                'page' => $page,
                'last_page' => ceil($total / 9)
            ]
        ];
    }
}
