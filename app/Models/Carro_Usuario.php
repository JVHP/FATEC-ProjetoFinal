<?php

namespace App\Models;

use Detalhes_Carro_Usuario;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carro_Usuario extends Model
{
    use HasFactory;

    protected $table = 'carro_usuarios';
    protected $fillable = ['id_carro', 'id_usuario'];

    public function detalhes_carro_usuario() {
        return $this->hasOne(Detalhes_Carro_Usuario::class, "id_carro_usuario", "id");
    }
}