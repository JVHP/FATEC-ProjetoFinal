<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = ['id_usuario', 'vl_preco_total', 'dt_pedido', 'dt_pagamento', 'ck_finalizado', 'id_empresa'];

    public function pecas() {
        return $this->belongsToMany(Peca::class, 'peca_pedidos', 'id_pedido','id_peca');
    }

    public function usuario()
    {
        return $this->hasOne(User::class, 'id_usuario');
    }

    public function formatarData() {
        if ($this->dt_pagamento == null) {
            return null;
        }

        return $this->dt_pagamento->format('d/m/Y');
    }
}
