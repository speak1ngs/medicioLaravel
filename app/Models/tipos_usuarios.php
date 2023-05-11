<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipos_usuarios extends Model
{
    use HasFactory;

    function users()
    {
        return $this->hasMany(User::class);
    }

    protected $fillable  = [ 'descripcion'];
}
