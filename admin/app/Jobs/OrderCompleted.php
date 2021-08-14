<?php

namespace App\Jobs;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class OrderCompleted implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Order::create([
            'id' => $this->data['id'],
            'code' => $this->data['code'],
            'transaction_id' => $this->data['transaction_id'],
            'first_name' => $this->data['first_name'],
            'last_name' => $this->data['last_name'],
            'email' => $this->data['email'],
            'user_id' => $this->data['user_id'],
            'ambassador_email' => $this->data['ambassador_email'],
            'address' => $this->data['address'],
            'city' => $this->data['city'],
            'country' => $this->data['country'],
            'zip' => $this->data['zip'],
            'created_at' => $this->data['created_at'],
            'updated_at' => $this->data['updated_at'],
        ]);

        OrderItem::insert($this->data['order_items']);
    }
}
