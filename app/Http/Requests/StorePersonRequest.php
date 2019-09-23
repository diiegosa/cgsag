<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePersonRequest extends FormRequest
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
        //dd($this);
        return [
            'name' => 'required',
            'city_id' => 'required',
            'photo' => 'required|image|mimes:jpeg,jpg,png',
            'date_of_birth' => 'nullable|date_format:"d/m/Y"',
            'email' => 'nullable|email|unique:people',
            'interest_inputs.*' => 'nullable|min:3|unique:interests,name' 

        ];
    }

    public function messages()
    {
      return [
       'name.required' => 'O campo Nome precisa ser preenchido',
       'city_id.required' => 'Selecione uma Cidade',
       'photo.required' => 'Uma Foto precisa ser selecionada',
       'photo.mimes' => 'A foto deve ser jpeg, jpg ou png',
       'photo.image' => 'A foto deve ser jpeg, jpg ou png',
       'date_of_birth.date_format' => 'A data deve ter o formato dd/mm/aaaa',
       'email.unique' => 'Este email já foi cadastrado',
       'interest_inputs.*.min' => 'Cada interesse cadastrado deve possuir mais de dois caracteres',
       'interest_inputs.*.unique' => "Uma das áreas de interesse digitadas já existe. Encontre-a no campo 'Selecione as áreas de interesse'",
      ];
    }
}
