<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarioDetalles extends Model
{
    use HasFactory;

    protected $fillable = ['dias_laborales', 'horarios', 'calendarios_doctores_id','stat_id'];

}
