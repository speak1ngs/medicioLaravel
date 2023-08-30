<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class CreateRol extends Component
{
    public $rol;

    public function resetWords() {
        $this->reset(['rol']);
    }


    public function createRol() {
        Role::create(['name' => $this->rol]);
        $this->resetWords();
    }


 
    public function render()
    {
        return view('livewire.create-rol');
    }
}
