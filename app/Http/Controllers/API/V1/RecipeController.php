<?php

namespace App\Http\Controllers\API\V1;

use App\Recipe;
use Illuminate\Http\Request;
use App\Http\Requests\CreateRecipe;
use App\Http\Controllers\Controller;
use App\Services\Contracts\RecipeServiceContract;
use App\Services\Contracts\IngredientServiceContract;

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
        RecipeServiceContract $recipeService,
        IngredientServiceContract $ingredientService
    ) {
        $this->recipeService = $recipeService;
        $this->ingredientService = $ingredientService;
    }

    /**
     * Create a new recipe
     *
     * @param CreateRecipe $request
     *
     * @return Response
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
     * @return Response
     */
    public function index(Request $request)
    {
        $response = $this->recipeService->getAllRecipes($request);
        
        return response()->json($response, 200);
    }

    /**
     * Delete a user's recipe
     *
     * @param Recipe $recipe
     *
     * @return Response
     */
    public function destroy(Recipe $recipe)
    {
        $recipe->delete();

        return response()->json("", 204); 
    }
}
