<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carro_Usuario extends Model
{
    use HasFactory;

    protected $fillable = ['id_carro', 'id_usuario'];
}
