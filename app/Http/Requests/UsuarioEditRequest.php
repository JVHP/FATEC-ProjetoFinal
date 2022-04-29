<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioEditRequest extends FormRequest
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
            'nm_usuario'=>'required',
            'email'=>'required',
            'cd_idade'=>'required',
            'ds_endereco'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'nm_usuario.required'=>'Nome é obrigatório',
            'email.required'=>'E-Mail é obrigatório',
            'cd_idade.required'=>'Idade é obrigatória',
            'ds_endereco.required'=>'Endereço é obrigatório',
        ];
    }
}
