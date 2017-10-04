<?php

namespace App\Services\Contracts;

interface IngredientServiceContract
{
    public function create($request);

    public function getAll(): array;

    public function delete($ingredient);
}
