<?php

namespace App\Http\Controllers\API\V1;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class: UserController
 *
 * @see Controller
 */
class UserController extends Controller
{

    // just used for testing purposes
    public function index(Request $request)
    {
        return $request->user();
    }


}
