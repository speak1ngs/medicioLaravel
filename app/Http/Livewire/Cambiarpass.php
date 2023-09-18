<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Cambiarpass extends Component
{
    public $inputPassword1, $inputPassword2;
    public $statAlert ,$title, $text;
    protected $listeners= ['render'];
    
    public function setNewPW() 
    {
        if($this->inputPassword1 === $this->inputPassword2){
            try {
                User::where('id','=',Auth::user()->id)->update([
                    'password' => Hash::make($this->inputPassword2)
                ]);
                session()->flash('message','Se cambio la contraseña');
                $this->statAlert = 'success';
                $this->title = 'Exito';
                $this->text = 'Se cambio la contraseña';
            } catch (\Throwable $th) {
                $this->statAlert = 'error';
                $this->title = 'Error';
                $this->text = 'No se pudo acceder a la base de datos';
            }
            $this->alert();
            $this->reset(['inputPassword1','inputPassword2']);
            $this->emitSelf('render');
        }
        else{
            session()->flash('message','Los campos introducidos no son iguales');
        }
    }



    
    public function alert()
    {

        $this->dispatchBrowserEvent('swal:modal', [

                'icon' => $this->statAlert,  
                'title' => $this->title,
                'text' => $this->text,
            ]);

    }



    public function render()
    {
        return view('livewire.cambiarpass');
    }
}
