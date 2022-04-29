<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto_Carro extends Model
{
    use HasFactory;

    protected $fillable = ['nm_original', 'nm_armazenamento', 'id_carro'];

    public $timestamps = false;
}
