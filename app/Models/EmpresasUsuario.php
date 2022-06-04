<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EmpresasUsuario extends Model
{
    use HasFactory;

    protected $table = 'empresas_usuarios';

    protected $fillable = ["id_usuario", "id_empresa", "ck_tipo_cadastro"];

}
