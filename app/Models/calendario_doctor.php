<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class calendario_doctor extends Model
{
    use HasFactory;
    protected $table= 'calendarios_doctores';
    
    public function citas()
    {
        return $this->belongsTo(cita::class);
    }



    protected $fillable = ['horario_inicio', 'horario_fin', 'costo_consulta','dias','doctores_id', 'consultorios_id'];

}
