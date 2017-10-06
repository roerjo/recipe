<?php

namespace App\Http\Controllers\API\V1;

use App\Ingredient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class: IngredientController
 *
 * @see Controller
 */
class IngredientController extends Controller
{
    /**
     * Retrieve all ingredients
     *
     * @return Response
     */
    public function index()
    {
        $ingredients = Ingredient::all();

        return response()->json(
            ["ingredients" => $ingredients], 200
        );
    }
}
