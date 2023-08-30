<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasRoles;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'paciente_id',
        'doctor_id',
        'tipo_usaurio_id',
        'persona_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    function pacientes()
    {
        return $this->hasOne(paciente::class,'id','paciente_id');
    }

    function doctores()
    {
        return $this->hasOne(doctores::class, 'id', 'doctor_id');
    }


    function personas()
    {
        return $this->hasOne(persona::class, 'id', 'persona_id');
    }


    function posts()
    {
        return $this->hasOne(post::class);
    }

    function tipos_usuarios(){

        return $this->hasOne(tipos_usuarios::class,'id', 'tipo_usuario_id');
    }


}
