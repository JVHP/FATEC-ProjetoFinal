<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Carro_Usuario extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id_carro'=>['required'],
            'id_usuario'=>['required'],
        ];
    }

    public function messages()
    {
        return [
            'id_carro.required' => 'Selecione um carro.',
            'id_usuario' => 'Usuário não encontrado.',
        ];
    }
}
