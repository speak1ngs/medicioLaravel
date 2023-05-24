<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class especialidades extends Model
{
    use HasFactory;


    public function calendario_doctore(){
        return $this->hasMany(calendarios_doctores::class);
    }


    protected $fillable = [
        'descripcion'
     ];
 }

