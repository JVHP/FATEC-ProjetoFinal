<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificacaoManutencaoCarro extends Model
{
    use HasFactory;

    protected $fillable = ['id_carro_usuario'];

    public $timestamps = false;

}
