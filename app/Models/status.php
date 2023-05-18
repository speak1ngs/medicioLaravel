<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class status extends Model
{
    use HasFactory;


    public function consultorios()
    {
        return $this->hasMany(consultorio::class);
    }

    public function pacientes()
    {
        return $this->hasMany(paciente::class);
    }

    public function doctores()
    {
        return $this->hasMany(doctores::class);
    }

    protected $fillable  = [ 'descripcion'];
}
