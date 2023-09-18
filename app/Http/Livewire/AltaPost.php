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
    public $statAlert ,$title, $text;
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

    public function alert()
    {

        $this->dispatchBrowserEvent('swal:modal', [

                'icon' => $this->statAlert,  
                'title' => $this->title,
                'text' => $this->text,
            ]);

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


                // session()->flash('message', 'Post activado'); 


                try {
               
                    $image=$this->upload();
                    post::where('id','=', $this->idp)->update([
                        'titulo' => $this->inputTitle,
                        'body' => $this->inputBody,
                        'foto_url' => $image,
                        'status_id'=> 1,
                    ]);
                    $this->statAlert = 'success';
                    $this->title = 'Exito';
                    $this->text = 'Post editado y activado';

                } catch (\Throwable $th) {
                    $this->statAlert = 'error';
                    $this->title = 'Error';
                    $this->text = 'No se pudo acceder a la base de datos';
                }

            }
            else{
                

                try {
                    post::where('id','=', $this->idp)->update([
                        'titulo' => $this->inputTitle,
                        'body' => $this->inputBody,
                        'foto_url' => $this->inputFotoUrl,
                        'status_id'=> 1,
                    ]);
                    $this->statAlert = 'success';
                    $this->title = 'Exito';
                    $this->text = 'Post editado y activado';
                } catch (\Throwable $th) {
                    $this->statAlert = 'error';
                    $this->title = 'Error';
                    $this->text = 'No se pudo acceder a la base de datos';
                }

            }
        } catch (\Throwable $th) {
            $this->statAlert = 'error';
            $this->title = 'Error';
            $this->text = 'No se pudo acceder a la base de datos';
        }
        $this->alert();
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
                $this->statAlert = 'success';
                $this->title = 'Exito';
                $this->text = 'Post Activado';
                
            }
            else{
                $db= post::where('id','=', $this->idp)->update([
                    'status_id'=> 2,
                ]);
                $this->statAlert = 'success';
                $this->title = 'Exito';
                $this->text = 'Post Desactivado';
                
            }
        
        } catch (\Throwable $th) {
            $this->statAlert = 'error';
            $this->title = 'Error';
            $this->text = 'No se pudo acceder a la base de datos';
            
        }

        $this->alert();
   

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
