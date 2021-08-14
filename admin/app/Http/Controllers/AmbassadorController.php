<?php

namespace App\Http\Controllers;


use Services\UserService;

class AmbassadorController extends Controller
{
    public UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = collect($this->userService->get('users'));

        return $users->filter(fn($user) => $user['is_admin'] === 0)->values();
    }
}
