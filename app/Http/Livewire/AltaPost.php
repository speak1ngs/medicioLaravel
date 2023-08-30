<?php

namespace App\Http\Livewire;

use App\Models\post;
use App\Models\post_stat;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class AltaPost extends Component
{   
    public $inputTitle, $inputBody, $inputFotoUrl, $cant, $inputState, $inputFotoUrlNew;
    public $control,  $idp, $search;
    public $statPost ;
    public $state = [];
    public $flag = 0; 
    use WithPagination;
    use WithFileUploads;

    public function mount()
    {   
        $this->statPost = "activar";
        $this->control = 'failComment';
        $this->cant = 10;
        $this->search= "";
        $this->state = post_stat::all();
        $this->inputState = 3;
    }
    public function upload() 
    {   
            $this->validate(
            ['inputFotoUrlNew' => 'image',]);
            
            return $this->inputFotoUrlNew->store('postimage', 'public');
    }



    public function dataSet($iden ,$val, $titulo, $body ,$foto_url) 
    {
  

        $this->statPost = $val;
        $this->idp = $iden;
        $this->inputTitle = $titulo;
        $this->inputBody = $body;
        $this->inputFotoUrl = $foto_url;
        
    }

    public function editData() 
    {
        try {
            if(!empty($this->inputFotoUrlNew)){


                $image=$this->upload();
                post::where('id','=', $this->idp)->update([
                    'titulo' => $this->inputTitle,
                    'body' => $this->inputBody,
                    'foto_url' => $image,
                    'status_id'=> 1,
                ]);
                session()->flash('message', 'Post activado'); 
            }
            else{
                
                post::where('id','=', $this->idp)->update([
                    'titulo' => $this->inputTitle,
                    'body' => $this->inputBody,
                    'foto_url' => $this->inputFotoUrl,
                    'status_id'=> 1,
                ]);
     
            }
        } catch (\Throwable $th) {
            session()->flash('message', 'Error al conectar a la BD');
        }

    }

    public function resetData() 
    {
        $this->reset(['statPost' ,'idp','inputTitle','inputBody','inputFotoUrl','inputFotoUrlNew']);
    }


    public function setPost() 
    {   
        try {
            if($this->statPost=== "activar"){
                $db= post::where('id','=', $this->idp)->update([
                    'status_id'=> 1,
                ]);
                session()->flash('message', 'Post activado'); 
                
            }
            else{
                $db= post::where('id','=', $this->idp)->update([
                    'status_id'=> 2,
                ]);
                session()->flash('message', 'Post desactivado'); 
                
            }
        
        } catch (\Throwable $th) {
            $this->control = 'failComment';
            
        }

        if($this->control === "failComment"){
            session()->flash('message', 'Error al conectar a la BD');
        }
   

    }


    public function render()
    {
        
        $db = DB::table('posts')
        ->select('id','titulo','body','foto_url','created_at',db::raw('(select descripcion from posts_stats where posts_stats.id = posts.status_id) as estado'))
        ->where('status_id','=', $this->inputState)
        ->where('titulo','like', '%' . $this->search . '%')
        ->paginate($this->cant);


        return view('livewire.alta-post', compact('db'));
    }
}
