<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class CreatPermission extends Component
{
    public $permiso;    

    public function resetWords() {
        $this->reset(['permiso']);
    }

    public function createPermi() {
        Permission::create(['name' => $this->permiso]);
        $this->resetWords();
    }


    public function render()
    {
        return view('livewire.creat-permission');
    }
}
