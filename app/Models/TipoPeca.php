<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPeca extends Model
{
    use HasFactory;

    protected $fillable = ['nm_tipo' ,'ck_ativo'];

    public function pecas() {
        return $this->belongsToMany(Peca::class, 'id', 'id_tipo_peca');
    }
}
