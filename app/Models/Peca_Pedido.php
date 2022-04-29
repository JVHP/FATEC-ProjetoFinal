<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peca_Pedido extends Model
{
    use HasFactory;

    protected $fillable = ['id_peca', 'id_pedido', 'qt_peca', 'vl_total_peca'];
}
