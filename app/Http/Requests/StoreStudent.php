<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudent extends FormRequest
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
            's_code'        => 'bail|required|string|max:10',
            'national_id'   => 'bail|nullable|string|max:14',
            'phone'         => 'bail|nullable|string|max:11',
            'address'       => 'bail|nullable|string|max:255',
            'modria'        => 'bail|required|exists:govs,id',
            'section'       => 'bail|required|exists:sections,id',
            'school'        => 'bail|required|exists:primary_schools,id',
            'name'          => 'bail|required|string|min:5|max:150',
            'gender'        => 'bail|required|in:male,female',
            's_number'      => 'bail|required|digits:5',
            'arabic'        => 'bail|required|between:1,4',
            'english'       => 'bail|required|between:1,4',
            'dersat'        => 'bail|required|between:1,4',
            'al_gebra'      => 'bail|required|between:1,4',
            'handsa'        => 'bail|required|between:1,4',
            'total_math'    => 'bail|required|between:1,4',
            'science'       => 'bail|required|between:1,4',
            'total'         => 'bail|required|between:1,5',
            'deen'          => 'bail|required|between:1,4',
            'art'           => 'bail|required|between:1,4',
            'computer'      => 'bail|required|between:1,4',
            'notes'         => 'bail|nullable|string|max:255',
        ];
    }
}
