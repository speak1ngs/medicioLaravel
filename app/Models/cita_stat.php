<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cita_stat extends Model
{
    use HasFactory;

    public function cita()
    {
        return $this->hasMany(cita::class);
    }

}
