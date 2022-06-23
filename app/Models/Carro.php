<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carro extends Model
{
    use HasFactory;

    protected $fillable = ['nm_carro', 'id_tipo_carro', 'ano', 'id_marca', 'id_empresa'];

    public function pecas(){
        return $this->belongsToMany(Peca::class, 'carro_peca', 'carro_id', 'peca_id');
    }

    public function filial() {
        return $this->hasOne(Empresa::class, 'id', 'id_empresa');
    }
    
    public function marca(){
        return $this->belongsTo(Marca::class, 'id_marca', 'id');
    }
    
    public function tipoCarro(){
        return $this->belongsTo(TipoCarro::class, 'id_tipo_carro', 'id');
    }

    public function usuarios(){
        return $this->belongsToMany(User::class, 'carro_usuarios', 'id_carro', 'id_usuario');
    }

}
