<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class doctores extends Model
{
    use HasFactory;
    public function personas(){
        return $this->belongsTo(persona::class);
    }

    public function users(){
        return $this->belongsTo(user::class);
    }


    public function status(){
        return $this->belongsTo(status::class);
    }

    // muchos a muchos

    public function consultorios()
    {
        return $this->belongsToMany(consultorio::class);
    }


    protected $fillable = [
        'registro',
        'foto_url',
        'telefono_laboral',
        'registro_expericacion_fecha',
        'descripcion',
        'calificacion',
        'especialidades',
        'persona_id',
        'stat_id'
    ];
}
