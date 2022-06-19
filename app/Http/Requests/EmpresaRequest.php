<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpresaRequest extends FormRequest
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
            'cnpj' => ['required', 'max:14', 'cnpj'],
            'razao_social' => ['required', 'max:500'],
            'url_customizada' => ['required', 'max:20'],
        ];
    }
    
    public function messages()
    {
        return [
            'cnpj.required'=>'CNPJ é obrigatório',
            'cnpj.max'=>'O tamanho máximo para o CNPJ é de 14 caracteres',
            'cnpj.cnpj'=>'Insira um CNPJ válido',

            'razao_social.required' => 'Razão social é obrigatório.',
            'razao_social.max' => 'O tamanho máximo para Razão social é de 500 caracteres.',
            
            'url_customizada.required' => 'Código da url é obrigatório.',
            'url_customizada.max' => 'O tamanho máximo para o código da url é de 20 caracteres.',
        ];
    }
}
