<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Requests\CreateRecipe;
use App\Http\Controllers\Controller;
use App\Http\Services\RecipeService;
use App\Http\Services\IngredientService;

/**
 * Class: RecipeController
 *
 * @see Controller
 */
class RecipeController extends Controller
{
    private $recipeService;
    private $ingredientService;

    /**
     * Build controller dependencies
     *
     * @param RecipeService $recipeService
     */
    public function __construct(
        RecipeService $recipeService,
        IngredientService $ingredientService
    ) {
        $this->recipeService = $recipeService;
        $this->ingredientService = $ingredientService;
    }

    /**
     * Create a new recipe
     *
     * @param CreateRecipe $request
     *
     * @return RequestResponse
     */
    public function create(CreateRecipe $request)
    {
        $user = $request->user();

        $this->recipeService->createRecipe($request, $user);

        return response()->json('Success', 201);
    }

    /**
     * Retrieve all the user's recipes
     *
     * @param Request $request
     *
     * @return RequestResponse
     */
    public function index(Request $request)
    {
        $response = $this->getAllRecipes($request);
        
        return response()->json($response, 200);
    }
}
