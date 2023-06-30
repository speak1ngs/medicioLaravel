<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    use HasFactory;
    protected $table = "posts";


    public function posts_stats(){
        return $this->belongsTo(post_stat::class);
    }


    public function users()
    {
        return $this->hasOne(User::class);
    }


    protected $fillable = ['titulo','body','foto_url','user_id','status_id'];
}
