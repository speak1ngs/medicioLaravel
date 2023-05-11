<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class calles extends Model
{
    use HasFactory;


    public function consultorios(){
        return $this->hasMany(consultorio::class);
    }

    protected $fillable  = [ 'descripcion'];

}
