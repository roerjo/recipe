<?php

namespace App\Http\Controllers\API\V1;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    /**
     * Create a new user
     *
     * @param Request $request
     */
    public function register(Request $request)
    {
        $user = User::create(
            [
                'name' => $request->name,
                'password' => $request->password,
                'email' => $request->email,
                'isAdmin' => false,
            ]
        );

        return response()->json($user->createToken('devToken')->accessToken, 201);
    }
}
