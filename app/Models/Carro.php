<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carro extends Model
{
    use HasFactory;

    protected $fillable = ['nm_carro', 'id_tipo_carro', 'ano'];

    public function pecas(){
        return $this->belongsToMany(Peca::class);
    }
    
    public function tipoCarro(){
        return $this->belongsTo(TipoCarro::class, 'id_tipo_carro', 'id');
    }
}
