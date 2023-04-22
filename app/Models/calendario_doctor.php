<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class calendario_doctor extends Model
{
    use HasFactory;

    
    public function citas()
    {
        return $this->belongsTo(cita::class);
    }

    public function consultorios()
    {
        return $this->belongsToMany(consultorio::class);
    }

}
