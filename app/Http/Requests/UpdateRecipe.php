<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class: UpdateRecipe
 *
 * @see FormRequest
 */
class UpdateRecipe extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'instructions' => 'required',
            'ingredients' => 'required|array',    
            'ingredients.*.name' => 'required',
        ];
    }
}
