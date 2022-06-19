<?php

use App\Models\Carro_Usuario;
use Illuminate\Database\Eloquent\Model;

class Detalhes_Carro_Usuario extends Model {


    protected $table = "detalhes_carro_usuario";

    protected $fillable = ["id_carro_usuarios", "qt_kilometragem", "qt_media_kilometragem", "dt_ultima_troca_oleo"];

    public function carro_usuario() {
        return $this->belongsTo(Carro_Usuario::class, "id", "id_carro_usuarios");
    }

    protected $casts = [
        'dt_ultima_troca_oleo' => 'date',
    ];
}