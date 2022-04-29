<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $fillable=['nm_usuario', 'nm_email', 'cd_idade', 'ds_endereco', 'cd_cartao', 'cd_senha', 'nm_login', ''];

    /* public function carros() {
        return $this->belongsToMany('\App\Models\Carro');
    } */

}
