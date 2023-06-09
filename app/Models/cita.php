<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cita extends Model
{
    use HasFactory;

    protected $table = 'citas';


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


    protected $fillable = ['nro_operacion_pago', 'importe','descripcion_doctor', 'descripcion_paciente','cal_doc_id','cal_pac_id', 'status_id', 'paciente_id', 'calendarios_deta_id' , 'pago_id', 'medio_id', 'calificacion_status_id', 'paciente_status_id'];
}
