<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class persona extends Model
{
    use HasFactory;

    public function doctores(){
        return $this->hasOne(doctor::class);
    }


    public function pacientes(){
        return $this->hasOne(paciente::class);
    }

    public function paises(){
        return $this->belongsTo(pais::class);
    }

    public function barrios(){
        return $this->belongsTo(barrio::class);
    }

    public function ciudades(){
        return $this->belongsTo(ciudad::class);
    }

    protected $fillable = ['nombre', 'apellido', 'cedula','fecha_nacimiento', 'telefono_particular', 'edad','ciudad_id','pais_id', 'barrio_id'];
}
