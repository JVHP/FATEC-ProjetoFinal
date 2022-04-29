<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto_Usuario extends Model
{
    use HasFactory;

    protected $fillable = ['nm_original', 'nm_armazenamento', 'id_usuario'];

    public $timestamps = false;
}
