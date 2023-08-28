<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class doctores extends Model
{
    use HasFactory;
    // public function personas(){
    //     return $this->belongsTo(persona::class );
    // }

    public function users(){
        return $this->belongsTo(user::class);
    }


    public function statu(){
        return $this->belongsTo(status::class, 'stat_id', 'id');
    }

    public function persona() {
        return $this->belongsTo(persona::class,  'persona_id' , 'id');
    }

    public function calendarios_doctores() {
        return $this->hasMany(calendarios_doctores::class);
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
