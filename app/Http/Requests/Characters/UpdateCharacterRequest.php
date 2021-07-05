<?php

namespace App\Http\Requests\Characters;

use App\Rules\IsStarWarsYear;
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
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'max:255'],
            'culture' => ['nullable', 'string', 'max:255'],
            'born' => ['nullable', 'numeric', new IsStarWarsYear],
            'died' => ['nullable', 'numeric', new IsStarWarsYear],
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
