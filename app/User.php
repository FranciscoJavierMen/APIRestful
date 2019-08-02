<?php

namespace APIRestful;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'users';
    //Constante para verificar si usuario está verificado

    //Indicando que el campo es para una fecha
    protected $dates = ['deleted_at'];

    const USUARIO_VERIFICADO = '1';
    const USUARIO_NO_VERIFICADO = '0';

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
    //Mutador para transformar el nombre a minusculas
    public function setNameAttribute($value) {
        $this->attributes['name'] = strtolower($value);
    }

    //Accesor para poner mayúscula en el inicio de la palabra
    public function getNameAttribute($value) {
        return ucwords($value);
    }

    //Mutador transformar el correo a minusculas
    public function setEmailAttribute($value) {
        $this->attributes['email'] = strtolower($value);
    }




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
