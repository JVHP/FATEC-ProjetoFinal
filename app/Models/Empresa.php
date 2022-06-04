<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $fillable = [
        "cnpj", 
        "cnpj_mascara", 
        "razao_social", 
        "url_customizada", 
        "id_responsavel"
    ];


    public function gerarLink() {
        return env('APP_ENV') != 'local' ? 'https://'.$_SERVER['HTTP_HOST'].'/loja/'.$this->url_customizada : 'http://'.$_SERVER['HTTP_HOST'].'/loja/'.$this->url_customizada;
    }

}
