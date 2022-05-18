<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarroRequest extends FormRequest
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
            'nm_carro'=>['required', 'max:255'],
            'id_marca'=>['required'],
            'id_tipo_carro'=>['required'],
            'ano'=>['required', 'max:4'],
        ];
    }

    public function messages()
    {
        return [
            'nm_carro.required'=>'Nome do carro é obrigatório.',
            'nm_carro.max'=>'Tamanho máximo do nome é de 255 caracteres.',
            'id_marca.required'=>'Marca é obrigatória.',
            'id_tipo_carro.required'=>'Tipo do carro é obrigatório.',
            'ano.required'=>'Ano é obrigatório.',
            'ano.max'=>'Tamanho máximo para o ano é de 4 caracteres',
        ];
    }
}
