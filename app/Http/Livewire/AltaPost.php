<?php

namespace App\Http\Livewire;

use App\Models\post;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AltaPost extends Component
{
    public function render()
    {
        
        $db = DB::table('posts')->select('id','titulo','body','foto_url','created_at',db::raw('(select descripcion from posts_stats where posts_stats.id = posts.status_id) as estado'))->where('status_id','=',3)->get();


        return view('livewire.alta-post', compact('db'));
    }
}
