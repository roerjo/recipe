<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RecipeController extends Controller
{
    public function create(Request $request)
    {
        $user = $request->user();

        $this->validate(
            $request,
            [
                'name' => 'required'
            ]
        );
    }
}
