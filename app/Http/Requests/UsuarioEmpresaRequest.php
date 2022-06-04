<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioEmpresaRequest extends FormRequest
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
            'nm_usuario'=>['required', 'max:255'],
            'email'=>['required', 'email', 'max:255', 'unique:users'],
            'dt_nasc'=>'required',
            'cep'=>['required', 'max:8', 'min:8'],
            'cpf'=>['required', 'max:11', 'cpf'],
            'cnpj'=>['required', 'max:14', 'cnpj'],
            'nm_rua'=>['required', 'max:255'],
            'ds_bairro'=>['required', 'max:255'],
            'nr_casa'=>['required', 'max:10'],
        ];
    }

    public function messages()
    {
        return [
            'nm_usuario.required'=>'Nome é obrigatório',
            'nm_usuario.max'=>'Nome do usuário deve ter no máximo 255 caracteres ',
            'email.required'=>'E-Mail é obrigatório',
            'email.unique'=>'E-Mail já cadastrado',
            'email.email'=>'Insira um e-mail com formato válido',
            'email.max'=>'Email deve ter no máximo 255 caracteres ',
            'dt_nasc.required'=>'Data de nascimento é obrigatória',
            'cep.required'=>'CEP é obrigatório',
            'cep.max'=>'Limite de 8 caracteres',
            'cep.min'=>'CEP deve ter 8 caracteres',
            'cd_password.required'=>'Senha é obrigatória',
            'cpf.required'=>'CPF é obrigatório',
            'cpf.max'=>'O tamanho máximo para o CPF é de 11 caracteres',
            'cpf.cpf'=>'Insira um CPF válido',
            'nm_rua.required'=>'Rua é obrigatória',
            'nm_rua.max'=>'O tamanho máximo para o logradouro é de 255 caracteres',
            'ds_bairro.required'=>'Bairro é obrigatório',
            'ds_bairro.max'=>'O tamanho máximo para o bairro é de 255 caracteres',
            'nr_casa.required'=>'Nº da residência é obrigatório',
            'nr_casa.max'=>'O tamanho máximo para o número da residência é de 10 caracteres',
        ];
    }
}
