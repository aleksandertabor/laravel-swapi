<?php

namespace App\Http\Requests\Characters;

use App\Models\Character;
use Illuminate\Validation\Rule;
use Illuminate\Support\Collection;
use Illuminate\Foundation\Http\FormRequest;

class FilterCharactersRequest extends FormRequest
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
            'search' => ['nullable', 'string'],
            'gender' => ['nullable', 'string', Rule::in($this->genders())]
        ];
    }

    /**
     * Get the validated data from the request.
     *
     * @return array
     */
    public function validated() : Collection
    {
        return collect($this->validator->validated());
    }

    /**
     * Get all of the input and files for the request.
     *
     * @param  array|mixed|null  $keys
     * @return array
     */
    public function all($keys = null)
    {
        $input = parent::all($keys);

        $input['search'] = $this->query('search');

        $input['gender'] = $this->query('gender');

        return $input;
    }

    /**
     * Get all genders for gender filter.
     *
     * @return array
     */
    public function genders()
    {
        return Character::genders();
    }
}
