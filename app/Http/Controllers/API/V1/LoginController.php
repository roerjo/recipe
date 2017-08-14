<?php

namespace App\Http\Controllers\API\V1;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class: LoginController
 *
 * @see Controller
 */
class LoginController extends Controller
{
    /**
     * Create a new user
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function register(Request $request)
    {
        $user = User::create(
            [
                'firstName' => $request->first_name,
                'lastName' => $request->last_name,
                'password' => $request->password,
                'email' => $request->email,
                'isAdmin' => false,
            ]
        );

        return response()->json($user->createToken('devToken')->accessToken, 201);
    }

    /**
     * Login user that has an expired token
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function login(Request $request)
    {
        //validate email and password
        
        //return response()->json($user->createToken('devToken')->accessToken, 200);
    }
}
