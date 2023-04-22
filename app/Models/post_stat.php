<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post_stat extends Model
{
    use HasFactory;

    public function posts(){
        return $this->belongsTo(post::class);
    }
}
