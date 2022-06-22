<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Faturamento extends Model
{
    use HasFactory;

    protected $table = 'vw_faturamento';

    protected $fillable = [
                          "total_pedidos",
                          "total_concluido",
                          "total_cancelado",
                          "total_nao_finalizados",
                          "total_iturbo",
                          "porcentagem_concluido",
                          "porcentagem_cancelado",
                          "porcentagem_nao_finalizados",
                        ];


    public function formatarValor($valor) {
        if ($valor == 0) {
            return '---';
        }
        return 'R$ '.number_format($valor, 2, ',');
    }

}