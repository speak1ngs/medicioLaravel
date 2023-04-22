<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    use HasFactory;

    public function posts_stats(){
        return $this->belongsTo(post_stat::class);
    }


    public function users()
    {
        return $this->hasOne(User::class);
    }

}
