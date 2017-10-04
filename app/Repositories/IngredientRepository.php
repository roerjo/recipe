<?php

namespace App\Repositories;

use App\Ingredient;
use App\Repositories\Contracts\IngredientRepositoryContract;

/**
 * Class: IngredientRepository
 *
 * @see IngredientRepositoryContract
 */
class IngredientRepository implements IngredientRepositoryContract
{
    /**
     * Create ingredients from a recipe
     *
     * @param mixed $request
     * @param App\Recipe $recipe
     */
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
    
    /**
     * Retrieve all ingredients
     *
     * @return Collection
     */
    public function getAll()
    {
        return Ingredient::all();
    }

    /**
     * Update a recipe's ingredients
     *
     * @param array $addedIngredients
     * @param array $removedIngredients
     * @param App\Recipe $recipe
     */
    public function update(
        $addedIngredients,
        $removedIngredients,
        $recipe
    ) {
        foreach ($addedIngredients as $added) {

            $ingredient = Ingredient::create(
                [
                    'name' => $added,
                ]
            );
    
            $recipe->ingredients()->attach($ingredient->id);
        }

        foreach ($removedIngredients as $removed) {

            $ingredientRemoved = Ingredient::where(['name' => $removed])->first();

            $recipe->ingredients()->detach($ingredientRemoved->id);
        }
    }

    /**
     * Delete an ingredient
     *
     * @param App\Ingredient $ingredient
     */
    public function delete($ingredient)
    {
        $ingredient->delete();
    }
}
