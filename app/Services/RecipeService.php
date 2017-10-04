<?php

namespace App\Services;

use App\Services\Contracts\RecipeServiceContract;
use App\Repositories\Contracts\RecipeRepositoryContract;
use App\Repositories\Contracts\IngredientRepositoryContract;

/**
 * Class: RecipeService
 *
 * @see RecipeServiceContract
 */
class RecipeService implements RecipeServiceContract
{
    private $recipeRepository;
    private $ingredientRepository;

    /**
     * __construct
     *
     * @param RecipeRepositoryContract $recipeRepository
     * @param IngredientRepositoryContract $ingredientRepository
     */
    public function __construct(
        RecipeRepositoryContract $recipeRepository,
        IngredientRepositoryContract $ingredientRepository
    ) {
        $this->recipeRepository = $recipeRepository;
        $this->ingredientRepository = $ingredientRepository;
    }

    /**
     * Create a recipe and it's ingredients
     *
     * @param mixed $request
     * @param mixed $user
     */
    public function createRecipe($request, $user)
    {
        $recipe = $this->recipeRepository->create($request, $user); 

        $this->ingredientRepository->createFromRecipe($request, $recipe);
    }

    /**
     * Retrieve all the users recipes
     *
     * @param mixed $request
     *
     * @return array
     */
    public function getAllRecipes($request): array
    {
        $recipes = $this->recipeRepository->getAll($request->user()->id);
        
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

            $response = ['recipes' => 'No recipes'];

        }

        return $response;
    }

    /**
     * Update a recipe
     *
     * @param mixed $request
     * @param App\Recipe $recipe
     */
    public function update($request, $recipe)
    {
        if ($request->name) {

            $this->recipeRepository->update($request, $recipe);

        }

        $addedIngredients = $request->ingredients->added_ingredients;
        $removedIngredients = $request->ingredients->removed_ingredients;

        $this->ingredientRepository->update(
            $addedIngredients, 
            $removedIngredients, 
            $recipe
        );
    }

    /**
     * Delete a recipe
     *
     * @param mixed $recipe
     */
    public function delete($recipe)
    {
        $this->recipeRepository->delete($recipe);
    }
}
