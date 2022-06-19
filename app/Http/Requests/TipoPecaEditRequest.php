<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TipoPecaRequest extends FormRequest
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
            'nm_tipo' => 'required',
            'id_empresa'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'nm_tipo.required'=>'Nome é obrigatório',
            'id_empresa.required'=>'Escolha uma de suas filiais.',
        ];
    }
}
