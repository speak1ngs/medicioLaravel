<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stat extends Model
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
        return $this->hasMany(doctor::class);
    }

}
