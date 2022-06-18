<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoCarro extends Model
{
    use HasFactory;
    
    protected $fillable = ['nm_tipo', 'id_empresa'];
    
    public function filial() {
        return $this->hasOne(Empresa::class, 'id', 'id_empresa');
    }
}
