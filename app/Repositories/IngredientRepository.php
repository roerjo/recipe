<?php

namespace App\Repositories;

use App\Ingredient;
use App\Repositories\Contracts\IngredientRepositoryContract;

class IngredientRepository implements IngredientRepositoryContract
{
    public function createFromRecipe($request, $recipe)
    {
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
    
    public function getAll()
    {
        return Ingredient::all();
    }

    public function delete($ingredient)
    {
        $ingredient->delete();
    }
}
