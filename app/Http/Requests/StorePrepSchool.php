<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePrepSchool extends FormRequest
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
            'section'   => 'bail|required|exists:sections,id',
            'name'      => 'bail|required|string|max:100',
            'gender'    => 'bail|required|in:male,female,both'
        ];
    }
}
