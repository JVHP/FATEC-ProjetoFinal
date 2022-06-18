<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPeca extends Model
{
    use HasFactory;

    protected $table = 'tipo_pecas';

    protected $fillable = ['nm_tipo' ,'ck_ativo', 'id_empresa'];
    
    public function filial() {
        return $this->hasOne(Empresa::class, 'id', 'id_empresa');
    }

    public function pecas() {
        return $this->hasMany(Peca::class, 'id_tipo_peca', 'id');
    }
}
