<?php

namespace App\Repositories;

use App\Recipe;
use App\Repositories\Contracts\RecipeRepositoryContract;

/**
 * Class: RecipeRepository
 *
 * @see RecipeRepositoryContract
 */
class RecipeRepository implements RecipeRepositoryContract
{
    /**
     * Create a new recipe
     *
     * @param mixed $request
     * @param mixed $user
     *
     * @return Recipe
     */
    public function create($request, $user)
    {
        return Recipe::create(
            [
                'name' => $request->name,
                'user_id' => $user->id,
            ]
        );
    }

    /**
     * Retrieve all user recipes
     *
     * @param int $userId
     *
     * @return Collection
     */
    public function getAll($userId)
    {
        return Recipe::with('ingredients')->where('user_id', $userId)->get();
    }

    /**
     * Delete a recipe
     *
     * @param mixed $recipe
     */
    public function delete($recipe)
    {
        $recipe->delete();
    }
}
