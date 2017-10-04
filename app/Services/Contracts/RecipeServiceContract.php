<?php

namespace App\Services\Contracts;

interface RecipeServiceContract
{
    public function createRecipe($request, $user);

    public function getAllRecipes($request): array;

    public function delete($recipe);
}
