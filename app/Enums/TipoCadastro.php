<?php
namespace App\Enums;

use Illuminate\Validation\Rules\Enum;

abstract class TipoCadastro extends Enum {
    const Empresa = "E";    
    const Funcionario = "F";    
    const Cliente = "C";    
}