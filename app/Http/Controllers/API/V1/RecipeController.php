<?php

namespace App\Http\Controllers\API\V1;

use App\Recipe;
use App\Ingredient;
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
                'name' => 'required',
            ]
        );
        
        $recipe = Recipe::create(
            [
                'name' => $request->name,
                'user_id' => $user->id,
            ]
        );

        $recipe_ingredients = [];

        foreach ($request->ingredients as $ingredient) {

            $ingredient = Ingredient::create(
                [
                    'name' => $ingredient['name'],
                ]
            );

            $recipe_ingredients[] = $ingredient->id;

        }
        
        $recipe->ingredients()->attach($recipe_ingredients);

        return response()->json('Success', 201);
    }

    public function index(Request $request)
    {
        $recipes = Recipe::with('ingredients')->where('user_id', $request->user()->id)->get();
        
        foreach ($recipes as $recipe) {

            $ingredients = [];

            foreach ($recipe->ingredients as $ingredient) {
                $ingredients[] = $ingredient->name;
            }

            $build[] = [
                'name' => $recipe->name,
                'ingredients' => $ingredients ? $ingredients : '',
            ];
        
            $response['recipes'] = $build;

            unset($ingredients);
        }
        
        return response()->json($response, 200);
    }
}
