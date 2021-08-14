<?php

namespace Database\Seeders;

use App\Models\OrderItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orderItems = DB::connection('old_mysql')->table('order_items')->get();

        foreach ($orderItems as $item) {
            OrderItem::create([
                'id' => $item->id,
                'order_id' => $item->order_id,
                'product_title' => $item->product_title,
                'price' => $item->price,
                'quantity' => $item->quantity,
                'ambassador_revenue' => $item->ambassador_revenue,
                'admin_revenue' => $item->admin_revenue,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
            ]);
        }
    }
}
