<?php

namespace App\Http\Controllers;

use App\Jobs\LinkCreated;
use App\Models\Link;
use App\Models\LinkProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Services\UserService;

class LinkController extends Controller
{
    public UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function store(Request $request)
    {
        $user = $this->userService->get('user');

        $link = Link::create([
            'user_id' => $user['id'],
            'code' => Str::random(6)
        ]);

        $linkProducts = [];

        foreach ($request->input('products') as $product_id) {
            $linkProduct = LinkProduct::create([
                'link_id' => $link->id,
                'product_id' => $product_id
            ]);

            $linkProducts[] = $linkProduct->toArray();
        }

        $array = $link->toArray();
        $array['link_products'] = $linkProducts;

        LinkCreated::dispatch($array)->onQueue('checkout_topic');
        LinkCreated::dispatch($array)->onQueue('admin_topic');

        return $link;
    }
}
