<?php

namespace App\Services\Contracts;

/**
 * Interface: IngredientServiceContract
 */
interface IngredientServiceContract
{
    public function create($request);

    public function getAll(): array;

    public function delete($ingredient);
}
