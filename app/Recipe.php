<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = [
        'name',
        'directions',
        'user_id',
    ]; 

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class);
    }   

    public static function newRecipe($request)
    {
        $recipe = static::create(
            [
                'name' => $request->recipe['name'],
                'user_id' => $request->user()->id,    
            ]
        );

        event(new \App\Events\RecipeCreated($recipe, $request));

        return $recipe;
    }
}
