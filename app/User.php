<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //Constante para verificar si usuario está verificado
    const USUARIO_VERIFICADO = '1';
    const USUARIO_NO_VERIFICADO = '0'

    //Constantes para verificar si usuario es administrador
    const USUARIO_ADMINISTRADOR = 'true';
    const USUARIO_REGULAR = 'false';

    protected $fillable = [
        'name',
        'email',
        'password',
        'verified',
        'verification_token',
        'admin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 
        'remember_token',
        'verification_token',
    ];

    //Funcion para verificar si el usuario está verificado
    public function esVerificado() {
        return $this->verified == User::USUARIO_VERIFICADO;
    }

    //Funcion para verificar si el usuario es administrador
    public function esAdministrador() {
        return $this->admin == User::USUARIO_ADMINISTRADOR;
    }

    //Funación para generar el token de verificación
    public static function generarVerificationToken() {
        return str_random(40);
    }


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
