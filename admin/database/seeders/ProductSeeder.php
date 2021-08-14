<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = DB::connection('old_mysql')->table('products')->get();

        foreach ($products as $product){
            Product::create([
                'id' => $product->id,
                'title' => $product->title,
                'description' => $product->description,
                'image' => $product->image,
                'price' => $product->price,
                'created_at' => $product->created_at,
                'updated_at' => $product->updated_at,
            ]);
        }
    }
}
