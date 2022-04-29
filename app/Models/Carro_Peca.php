<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carro_Peca extends Model
{
    use HasFactory;

    protected $table = 'carro_pecas';
    protected $fillable = ['id_peca', 'id_carro'];
}
