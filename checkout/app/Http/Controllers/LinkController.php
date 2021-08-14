<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Services\UserService;

class LinkController extends Controller
{
    public UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function show($code)
    {
        $link = Link::with('products')->where('code', $code)->first();

        $user = $this->userService->get("users/{$link->user_id}");

        $link['user'] = $user;

        return $link;
    }
}
