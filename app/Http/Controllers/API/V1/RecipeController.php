<?php

namespace App\Http\Controllers\API\V1;

use App\Recipe;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateRecipe;
use App\Http\Requests\CreateRecipe;
use App\Http\Controllers\Controller;

/**
 * Class: RecipeController
 *
 * @see Controller
 */
class RecipeController extends Controller
{
    
    /**
     * Build controller dependencies
     */
    public function __construct()
    {
        //
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
        $recipe = Recipe::create(
            [
                'name' => $request->recipe['name'],
                'description' => $request->recipe['description'],
                'instructions' => $request->recipe['instructions'],
                'user_id' => $request->user()->id,    
            ]
        );

        event(new \App\Events\RecipeCreatedOrUpdated($recipe, $request));

        return response()->json(
            [
                "recipe" => $recipe->load('ingredients'),
            ],
            201
        );
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
        $recipes = Recipe::with('ingredients')
            ->where('user_id', $request->user()->id)
            ->get();
        
        return response()->json(
            [
                'recipes' => $recipes, 
            ],
            200
        );
    }

    /**
     * Update a recipe
     *
     * @param UpdateRecipe $request
     * @param Recipe $recipe
     *
     * @return Response
     */
    public function update(UpdateRecipe $request, Recipe $recipe)
    {
        $recipe->name = $request->recipe['name'];
        $recipe->save();

        event(new \App\Events\RecipeCreatedOrUpdated($recipe, $request));

        return response()->json(
            [
                "recipe" => $recipe->load('ingredients'),
            ],
            200
        );
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
