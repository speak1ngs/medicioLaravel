<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PacientesStatus extends Model
{
    use HasFactory;

    protected $table = "pacientes_status";

    protected $fillable = ['descripcion'];
}
