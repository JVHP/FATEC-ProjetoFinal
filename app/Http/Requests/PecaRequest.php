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
            'nm_peca'=>'required',
            'vl_peca'=>'required',
            'qt_estoque'=>'required',
        ];
    }
    
    public function messages()
    {
        return [
            'nm_peca.required'=>'Nome é obrigatório',
            'vl_peca.required'=>'Valor é obrigatório',
            'qt_estoque.required'=>'Estoque é obrigatório',
        ];
    }
}
