<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
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
            'email'=>'unique:users',
            'emailC'=>'required',
            'emailC'=>'unique:users,email',
            'cd_idade'=>'required',
            'ds_endereco'=>'required',
            'cd_password'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'nm_usuario.required'=>'Nome é obrigatório',
            'email.required'=>'E-Mail é obrigatório',
            'email.unique'=>'E-Mail já cadastrado',
            'emailC.required'=>'E-Mail é obrigatório',
            'emailC.unique'=>'E-Mail já cadastrado',
            'cd_idade.required'=>'Idade é obrigatória',
            'ds_endereco.required'=>'Endereço é obrigatório',
            'cd_password.required'=>'Senha é obrigatória',
        ];
    }
}
