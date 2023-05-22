<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class consultorio extends Model
{
    
    public function paises(){
        return $this->belongsTo(paises::class);
    }

    public function barrios(){
        return $this->belongsTo(barrios::class);
    }

    public function ciudades(){
        return $this->belongsTo(ciudades::class);
    }

    public function calles(){
        return $this->belongsTo(calles::class);
    }

    public function status(){
        return $this->belongsTo(status::class);
    }


   


    protected $fillable = ['nombre' , 'social_instagram', 'social_facebook' , 'social_twitter', 'social_web_site', 'ruc','telefono','intervalo_consulta','foto_url', 'latitud', 'longitud', 'pais_id', 'calle_principal_id' ,'calle_secundaria_id', 'calle_terciaria_id', 'barrio_id','stat_id'];
}
