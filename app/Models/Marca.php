<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;

    protected $fillable = ['nm_marca', 'ck_categoria_marca'/* Carro - C; Peça - P */, 'ds_marca'];
}
