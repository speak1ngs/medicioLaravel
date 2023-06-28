<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CitasCalificacionStatus extends Model
{
    use HasFactory;

    protected $table = "citas_calificacion_status";

    protected $fillable = ['descripcion'];
}
