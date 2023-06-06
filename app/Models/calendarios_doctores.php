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
        return $this->belongsTo(especialidades::class);
    }



    protected $fillable = ['horario_inicio', 'horario_fin', 'costo_consulta','dias','meses','doctores_id', 'consultorios_id', 'especialidades_id'];
}
