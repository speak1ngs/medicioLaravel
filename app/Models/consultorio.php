<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class consultorio extends Model
{
    
    public function paises(){
        return $this->belongsTo(pais::class);
    }

    public function barrios(){
        return $this->belongsTo(barrio::class);
    }

    public function ciudades(){
        return $this->belongsTo(ciudad::class);
    }

    public function calles(){
        return $this->belongsTo(calle::class);
    }

    public function status(){
        return $this->belongsTo(stat::class);
    }


    // muchos a muchos
    public function doctores()
    {
        return $this->belongsToMany(doctor::class);
    }


    public function calendarios_doctores()
    {
        return $this->belongsToMany(calendario_doctor::class);
    }

}
