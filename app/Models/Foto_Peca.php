<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto_Peca extends Model
{
    use HasFactory;

    protected $table = 'foto_pecas';
    protected $fillable = ['nm_original', 'nm_armazenamento', 'id_peca'];

    public $timestamps = false;
}
