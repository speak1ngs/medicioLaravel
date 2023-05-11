<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ciudades extends Model
{
    use HasFactory;

        
    public function personas(){
        return $this->hasMany(persona::class);
    }


    public function ciudades(){
        return $this->hasMany(ciudad::class);
    }

    protected $fillable  = [ 'descripcion'];

}
