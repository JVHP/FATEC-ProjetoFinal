<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Marca extends Model
{
    use HasFactory;

    protected $fillable = ['nm_marca', 'ck_categoria_marca'/* Carro - C; Peça - P */, 'ds_marca'];

    public function categoria() {
        if ($this->ck_categoria_marca == 'P') return 'Marca de Peças';
        else if ($this->ck_categoria_marca == 'C') return 'Marca de Carros';
        else if ($this->ck_categoria_marca == 'A') return 'Marca de Carros e Peças';
        else return null;
    }

    public function vinculados() {
        if ($this->ck_categoria_marca == 'P')
            return $this->hasMany(Peca::class, 'id_marca', 'id')->get();
        else if ($this->ck_categoria_marca == 'C')
            return $this->hasMany(Carro::class, 'id_marca', 'id')->get();
        else if ($this->ck_categoria_marca == 'A')
            return DB::table('marcas')
                    ->leftjoin('pecas', 'pecas.id_marca', 'marcas.id')
                    ->leftjoin('carros', 'carros.id_marca', 'carros.id')
                    ->where('id', '=', $this->id)
                    ->get();
        else 
            return [];
    }
}
