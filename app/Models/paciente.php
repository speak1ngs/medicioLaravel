<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class paciente extends Model
{
    use HasFactory;

    public function personas(){
        return $this->belongsTo(persona::class);
    }

    public function users(){
        return $this->belongsTo(user::class);
    }


    public function status()
    {
        return $this->belongsTo(stat::class);
    }

    public function citas()
    {
        return $this->belongsToMany(cita::class);
    }

}
