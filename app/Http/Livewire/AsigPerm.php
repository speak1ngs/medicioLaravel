<?php

namespace App\Http\Livewire;

use App\Models\persona;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Livewire\WithPagination;
use PhpParser\Node\Expr\Cast\Object_;

class AsigPerm extends Component
{
    public $Perm, $search, $nameUser, $idUser;
    public $cant=10;
    public $inputRol = [];
    public $inputRevoke = [];
    public $Rol, $RolRevoke;
    public $inputPerm;
    public $statAlert ,$title, $text;

    use WithPagination;

    public function mount() {


     
        $this->Perm = Permission::all();

    }

    
    public function alert()
    {

        $this->dispatchBrowserEvent('swal:modal', [

                'icon' => $this->statAlert,  
                'title' => $this->title,
                'text' => $this->text,
            ]);

    }

    public function closeModalAsign() {
        $this->reset(['cant','Rol','inputRol','inputRevoke','RolRevoke']);
    }

    public function showUser($iden, $name, $roles) {
        $this->idUser = $iden;
        $this->nameUser = $name;

        $rolesArr =Role::all()->toArray();
      
        foreach ($roles as $rol) {
            if(empty($roleDat)){
                $roleDat= array_filter($rolesArr,function ($val) use ($rol)
                { 
                    return $val['name'] != $rol;
                }
                );
            }
            else{
                $roleDat= array_filter($roleDat,function ($val) use ($rol)
                { 
                    return $val['name'] != $rol;
                }
                );
            }
        }
        if(!empty($roles)){
        $this->Rol =collect($roleDat) ;
        }
        else{
            $this->Rol = $rolesArr;
        }

        // array_filter( array_column($this->arryDay, 'month'))
        
    }


    public function revokeRolUser($iden, $name, $roles) {
        $this->idUser = $iden;
        $this->nameUser = $name;
        $roleDat = [];
        $rolesArr =Role::all()->toArray();

        foreach ($roles as $rol) {
           $value= $rolesArr[array_search( $rol, array_column($rolesArr, 'name'))];
            
          array_push(  $roleDat,$value);
          
        }   


        // $this->RolRevoke = collect($roleDat);
        $this->RolRevoke =  $roleDat;

        // array_filter( array_column($this->arryDay, 'month'))
        
    }

    
    public function revokeRol() {
        try {
            foreach($this->inputRevoke as $val ){
                User::find($this->idUser)->removeRole($val);
            }

            $this->statAlert = 'success';
            $this->title = 'Exitoso';
            $this->text = 'Se revocaron los roles al usuario.';
        } catch (\Throwable $th) {
            $this->statAlert = 'error';
            $this->title = 'Error';
            $this->text = 'No se pudo acceder a la base de datos';
        }
        $this->alert();
    }

    public function asigRol() {
        try {
            User::find($this->idUser)->syncRoles($this->inputRol);

            $this->statAlert = 'success';
            $this->title = 'Exitoso';
            $this->text = 'Se asignaron los roles al usuario.';
        } catch (\Throwable $th) {
            $this->statAlert = 'error';
            $this->title = 'Error';
            $this->text = 'No se pudo acceder a la base de datos';
        }
        $this->alert();
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
