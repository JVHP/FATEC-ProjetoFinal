<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peca_Promocao extends Model
{
    use HasFactory;

    protected $fillable = ['id_peca', 'pc_promocao', 'dt_vigencia_inicio', 'dt_vigencia_fim'];
}
