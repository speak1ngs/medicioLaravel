<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class calendarios_doctores extends Model
{
    use HasFactory;
    protected $table= 'calendarios_doctores';
   
    public function citas()
    {
        return $this->belongsTo(cita::class);
    }
    
    public function especialidad(){
        return $this->belongsTo(especialidades::class, 'especialidades_id', 'id');
    }

    public function doctores()
    {
        return $this->belongsTo(doctores::class, 'doctores_id', 'id');
    }

    public function consultorios(){
        return $this->belongsTo(consultorio::class, 'consultorios_id', 'id');
    }

    public function calendarios_detalles()
    {
        return $this->hasMany(CalendarioDetalles::class);
    }


    protected $fillable = ['horario_inicio', 'horario_fin', 'costo_consulta','dias','meses','doctores_id', 'consultorios_id', 'especialidades_id'];
}
