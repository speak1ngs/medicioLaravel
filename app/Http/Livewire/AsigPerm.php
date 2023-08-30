<?php

namespace App\Http\Livewire;

use App\Models\persona;
use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Livewire\WithPagination;


class AsigPerm extends Component
{
    public $Rol, $Perm, $search, $nameUser, $idUser;
    public $cant=10;
    public $inputRol = [];
    public $inputPerm;

    use WithPagination;

    public function mount() {


        $this->Rol = Role::all();
        $this->Perm = Permission::all();

    }
    public function closeModalAsign() {
        $this->reset(['cant']);
    }

    public function showUser($iden, $name) {
        $this->idUser = $iden;
        $this->nameUser = $name;
    }

    public function asigRol() {
        User::find($this->idUser)->syncRoles($this->inputRol);
    }

    public function render()
    {   
   
        
        $val = User::with([
        'tipos_usuarios',
        'pacientes',
        'doctores',
        'personas']);
        $val->whereRelation('personas','nombre','like','%'.$this->search . '%');
        $user = $val->paginate($this->cant);
        return view('livewire.asig-perm', compact('user'));
    }
}
