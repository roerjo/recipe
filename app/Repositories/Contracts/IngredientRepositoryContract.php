<?php

namespace App\Repositories\Contracts;

/**
 * Interface: IngredientRepositoryContract
 */
interface IngredientRepositoryContract
{
    public function createFromRecipe($request, $recipe);

    public function getAll();

    public function delete($ingredient);
}
