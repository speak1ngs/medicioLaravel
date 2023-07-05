<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Cambiarpass extends Component
{
    public $inputPassword1, $inputPassword2;

    public function setNewPW() 
    {
        if($this->inputPassword1 === $this->inputPassword2){
            try {
                User::where('paciente_id','=',3)->update([
                    'password' => Hash::make($this->inputPassword2)
                ]);
                session()->flash('message','Se cambio la contraseña');
            } catch (\Throwable $th) {
                session()->flash('message','Error al conectar a la DB');
            }
  
        }
        else{
            session()->flash('message','Los campos introducidos no son iguales');
        }
    }


    public function render()
    {
        return view('livewire.cambiarpass');
    }
}
