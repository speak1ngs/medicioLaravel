<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barrios extends Model
{
    use HasFactory;

    public function personas(){
        return $this->hasMany(persona::class);
    }


    public function consultorios(){
        return $this->hasMany(consultorio::class);
    }

    protected $fillable  = [ 'descripcion'];

}
