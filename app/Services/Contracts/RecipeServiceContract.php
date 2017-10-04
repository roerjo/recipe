<?php

namespace App\Services\Contracts;

/**
 * Interface: RecipeServiceContract
 */
interface RecipeServiceContract
{
    public function createRecipe($request, $user);

    public function getAllRecipes($request): array;

    public function delete($recipe);
}
