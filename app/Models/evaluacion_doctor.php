<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class evaluacion_doctor extends Model
{
    use HasFactory;
    protected $table = "evaluaciones_doctores";


    public function citas()
    {
        return $this->belongsToMany(cita::class);
    }
}
