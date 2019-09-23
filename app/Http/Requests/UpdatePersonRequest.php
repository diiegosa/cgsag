<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePersonRequest extends FormRequest
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
            'city_id' => 'required',
        ];
    }

    public function messages()
    {
      return [
       'name.required' => 'O campo Nome precisa ser preenchido',
       'city_id.required' => 'O campo Cidade precisa ser preenchido',
      ];
    }
}
