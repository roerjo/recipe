<?php

namespace App\Http\Controllers\API\V1;

use App\User;
use App\Http\Requests\LoginUser;
use App\Http\Requests\RegisterUser;
use Illuminate\Support\Facades\Hash;
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
     * @param RegisterUser $request
     *
     * @return RedirectResponse
     */
    public function register(RegisterUser $request)
    {
        $user = User::create(
            [
                'firstName' => $request->first_name,
                'lastName' => $request->last_name,
                'password' => bcrypt($request->password),
                'email' => $request->email,
                'isAdmin' => false,
            ]
        );

        return response()->json($user->createToken('devToken')->accessToken, 201);
    }

    /**
     * Login user that has an expired token
     *
     * @param LoginUser $request
     *
     * @return RedirectResponse
     */
    public function login(LoginUser $request)
    {
        $user = User::where('email', $request->email)->first();

        if (Hash::check($request->password, $user->password)) {

            $response = $user->createToken('devToken')->accessToken;
            $status = 200;

        } else {

            $response = ['error' => 'Incorrect login information'];
            $status = 401;

        } 

        return response()->json($response, $status);
    }
}
