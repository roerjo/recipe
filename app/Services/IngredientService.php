<?php

namespace App\Services;

use App\Services\Contracts\IngredientServiceContract;
use App\Repositories\Contracts\IngredientRepositoryContract;

/**
 * Class: IngredientService
 */
class IngredientService implements IngredientServiceContract
{
    private $ingredientRepository;

    /**
     * __construct
     *
     * @param IngredientRepositoryContract $ingredientRepository
     */
    public function __construct(IngredientRepositoryContract $ingredientRepository)
    {
        $this->ingredientRepository = $ingredientRepository;
    }

    /**
     * Create an ingredient
     *
     * @param mixed $request
     */
    public function create($request)
    {
        $this->ingredientRepository->create($request); 
    }

    /**
     * Retrieve all ingredients
     *
     * @return array
     */
    public function getAll(): array
    {
        $ingredients = $this->ingredientRepository->getAll();

        return [
            'ingredients' => $ingredients,
        ];
    }

    /**
     * Delete a recipe
     *
     * @param App\Ingredient $ingredient
     */
    public function delete($ingredient)
    {
        $this->ingredientRepository->delete($ingredient);
    }
}

