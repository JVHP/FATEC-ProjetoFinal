<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PecaRequest extends FormRequest
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
            'nm_peca'=>['required', 'max:254'],
            'vl_peca'=>'required',
            'qt_estoque'=>'required',
            'id_tipo_peca'=>'required',
            'id_marca'=>'required',
            'ds_peca'=>'max:500',
        ];
    }
    
    public function messages()
    {
        return [
            'nm_peca.required'=>'Nome da peça é obrigatório.',
            'nm_peca.max'=>'Tamanho máximo para o nome da peça é de 254 caracteres.',
            'vl_peca.required'=>'Valor da peça é obrigatório.',
            'qt_estoque.required'=>'Estoque da peça é obrigatório.',
            'id_tipo_peca.required'=>'Tipo da peça é obrigatório.',
            'id_marca.required'=>'Marca da peça é obrigatória.',
            'ds_peca.max'=>'Tamanho máximo para descrição é de 500 caracteres.',
        ];
    }
}
