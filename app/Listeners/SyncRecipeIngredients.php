<?php

namespace App\Listeners;

use App\Ingredient;
use App\Events\RecipeCreatedorUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SyncRecipeIngredients
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param RecipeCreatedOrUpdated $event
     *
     * @return void
     */
    public function handle(RecipeCreatedOrUpdated $event)
    {
        $recipe_ingredients = [];

        foreach ($event->request->ingredients as $ingredient) {
            
            $storedIngredient = Ingredient::firstOrCreate(
                [
                    'name' => $ingredient['name'],
                ]
            );

            $recipe_ingredients[] = $storedIngredient->id;
        
        }

        $event->recipe->ingredients()->sync($recipe_ingredients);
    }
}
