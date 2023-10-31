<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarioDetalles extends Model
{
    use HasFactory;
    protected $table = 'calendarios_detalles';

    public function calendarios_doctores()
    {
        return $this->belongsTo(calendarios_doctores::class, 'calendarios_doctores_id', 'id');
    }



    protected $fillable = ['dias_laborales', 'horarios', 'calendarios_doctores_id','stat_id'];

}
