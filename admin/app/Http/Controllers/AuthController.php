<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateInfoRequest;
use App\Http\Requests\UpdatePasswordRequest;
use Illuminate\Http\Request;
use Services\UserService;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->only('first_name', 'last_name', 'email', 'password') + ['is_admin' => 1];

        $user = $this->userService->post("register", $data);

        return response($user, Response::HTTP_CREATED);
    }

    public function login(Request $request)
    {
        $data = $request->only('email', 'password') + ['scope' => 'admin'];

        $response = $this->userService->post("login", $data);

        $cookie = cookie('jwt', $response['jwt'], 60 * 24); // 1 day

        return response([
            'message' => 'success'
        ])->withCookie($cookie);
    }

    public function user()
    {
        return $this->userService->get('user');
    }

    public function logout()
    {
        $cookie = \Cookie::forget('jwt');

        $this->userService->post('logout', []);

        return response([
            'message' => 'success'
        ])->withCookie($cookie);
    }

    public function updateInfo(UpdateInfoRequest $request)
    {
        $user = $this->userService->put('users/info',
            $request->only('first_name', 'last_name', 'email')
        );

        return response($user, Response::HTTP_ACCEPTED);
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = $this->userService->put('users/info', $request->only('password'));

        return response($user, Response::HTTP_ACCEPTED);
    }
}
