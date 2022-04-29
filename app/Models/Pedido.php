<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = ['id_usuario', 'vl_preco_total', 'dt_pedido', 'dt_pagamento', 'ck_finalizado'];

    public function pecas() {
        return $this->belongsToMany(Peca::class, 'peca_pedidos', 'id_pedido','id_peca');
    }

    public function usuario()
    {
        return $this->hasOne(User::class, 'id_usuario');
    }
}
