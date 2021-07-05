<?php

namespace App\Http\Requests\Characters;

use Illuminate\Support\Collection;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCharacterRequest extends FormRequest
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
            'name' => ['string', 'max:255'],
            'gender' => ['string', 'max:255'],
            'birth_year' => ['string', 'max:255'],
        ];
    }

    /**
     * Get the validated data from the request.
     *
     * @return Collection
     */
    public function validated() : Collection
    {
        return collect($this->validator->validated());
    }
}
