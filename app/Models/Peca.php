<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Peca extends Model
{
    use HasFactory;

    protected $fillable = ['nm_peca', 'vl_peca', 'qt_estoque', 'foto'];


    public function carros() {
        return $this->belongsToMany(Carro::class);
    }

    public function pedidos() {
        return $this->belongsToMany(Pedido::class, 'peca_pedidos', 'id_peca', 'id_pedido');
    }

    public function fotos(){
        return $this->hasOne(Foto_Peca::class, 'id_peca', 'id');
    }

    public function retirarDoEstoque($id){
        DB::table('pecas')->where('id', '=', $id)->decrement('qt_estoque');
        return 'success';
    }
}
