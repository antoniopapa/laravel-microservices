<?php

namespace Database\Seeders;

use App\Models\LinkProduct;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LinkProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $linkProducts = DB::connection('old_mysql')->table('link_products')->get();

        foreach ($linkProducts as $linkProduct) {
            LinkProduct::create([
                'id' => $linkProduct->id,
                'link_id' => $linkProduct->link_id,
                'product_id' => $linkProduct->product_id,
            ]);
        }
    }
}
