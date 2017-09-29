<?php

namespace App\Http\Services;

use App\Recipe;
use App\Ingredient;

class RecipeService
{
    public function createRecipe($request, $user)
    {
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
    }

    public function getAllRecipes($request)
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

        if (!isset($response)) {

            $response = "No recipes";

        }

        return $response;
    }
}
