<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class evaluacion_paciente_doctor extends Model
{
    use HasFactory;

    protected $table = "evaluaciones_pacientes";

    public function citas()
    {
        return $this->belongsToMany(cita::class);
    }
}
