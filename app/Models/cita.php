<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cita extends Model
{
    use HasFactory;

    public function calendarios_doctores()
    {
        return $this->hasMany(calendario_doctor::class);
    }

    public function citas_status()
    {
        return $this->belongsTo(cita_stat::class);
    }

    public function pagos_status()
    {
        return $this->belongsTo(pago_stat::class);
    }

    public function medios_pagos()
    {
        return $this->belongsTo(medio_pago::class);
    }


    public function evaluaciones_doctores()
    {
        return $this->belongsToMany(evaluacion_doctor::class);
    }

    public function evaluaciones_pacientes()
    {
        return $this->belongsToMany(evaluacion_paciente_doctor::class);
    }

    public function pacientes()
    {
        return $this->belongsToMany(paciente::class);
    }
}
