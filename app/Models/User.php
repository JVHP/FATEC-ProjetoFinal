<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'nm_usuario',
        'email',
        'password',
        'dt_nasc', 
        'cep', 
        'cd_cartao',
        'nm_login', 
        'is_admin'];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function pedidos() {
        return $this->hasMany(Pedido::class, 'id_usuario');
    }

    public function carros() {
        return $this->belongsToMany(Carro::class, 'carro_usuarios', 'id_usuario', 'id_carro');
    }

    public function isAdministrator() {
        return $this->is_admin;
    }

    public function firstName() {
        $fs_name  = $this->nm_usuario;
        ;

        foreach  (explode(' ', $fs_name) as $index => $val) {
            if ($index == 0) {
                $fs_name = $val;
            }
        }

        return $fs_name;
    }
}
