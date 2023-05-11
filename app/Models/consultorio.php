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

    protected $fillable = ['nombre' , 'social_instagram', 'social_facebook' , 'social_twitter', 'social_web_site', 'ruc','telefono','intervalo_consulta','foto_url', 'latitud', 'longitud', 'pais_id', 'calle_principal_id' ,'calle_secundaria_id', 'calle_terciaria_id', 'barrio_id','stat_id'];
}
