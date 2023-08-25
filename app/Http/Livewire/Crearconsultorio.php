<?php

namespace App\Http\Livewire;

use App\Models\barrios;
use App\Models\calles;
use App\Models\ciudades;
use App\Models\consultorio;
use App\Models\especialidades;
use App\Models\paises;
use Livewire\Component;
use Livewire\WithFileUploads;

class Crearconsultorio extends Component
{   
    public $inputNombre , $inputInsta, $inputFace,  $inputTwi, $inputWeb, $inputMap,
            $inputBarr, $inputCiud, $inputPais, $inputTelf, $inputIntervalo, $inputRuc, $inputFoto, $inputPrinc,
            $inputSecu, $inputTerc;

    public $barrio, $ciudad, $consul, $pais,  $calle;

    use WithFileUploads;

    public function mount() 
    {
        $this->barrio  = barrios::all();
        $this->ciudad = ciudades::all();
        $this->pais = paises::all();
        $this->calle = calles::all();

    }

    public function upload() 
    {   
            $this->validate(
            ['inputFoto' => 'image',]);
            
            return $this->inputFoto->store('consimg', 'public');
    }

    public function regConsul() 
    {
        $image=$this->upload();
        consultorio::create([
            'nombre' => $this->inputNombre, 
            'social_instagram' => $this->inputInsta,
            'social_facebook' => $this->inputFace,
            'social_twitter' => $this->inputTwi,
            'social_web_site' => $this->inputWeb,
            'ruc' => $this->inputRuc,
            'map' => $this->inputMap,
            'telefono' =>$this->inputTelf,
            'intervalo_consulta' => $this->inputIntervalo,
            'foto_url' => $image,
            'latitud' => null,
            'longitud'=> null,
            'pais_id' => $this->inputPais, 
            'calle_principal_id' => $this->inputPrinc,
            'calle_secundaria_id' => $this->inputSecu, 
            'calle_terciaria_id' => $this->inputTerc,
            'barrio_id' => $this->inputBarr,
            'stat_id' => 1
        ]);

        $this->reset(['inputNombre' , 'inputInsta', 'inputFace',  'inputTwi', 'inputWeb', 'inputMap',
        'inputBarr', 'inputCiud', 'inputPais', 'inputTelf', 'inputIntervalo', 'inputRuc', 'inputFoto', 'inputPrinc',
        'inputSecu', 'inputTerc']);
        $this->emitSelf('crearconsultorio');
        // $this->emit('alert','Consultorio registrado');
    }


    public function render()
    {
        return view('livewire.crearconsultorio');
    }
}
