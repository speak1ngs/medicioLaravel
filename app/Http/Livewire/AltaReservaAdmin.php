<?php

namespace App\Http\Livewire;

use App\Models\medio_pago;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class AltaReservaAdmin extends Component
{   
    use WithPagination;
    public $alert, $detail, $paymentMethod, $inputTypeMethod, $inputOpNumber, $search, $searchCI, $ide , $ideCalen, $namPac;
    public $datTemp = [];
    public $cant = 10;

  
    public function mount() 
    {
        $this->alert = "#reservaActive";
        $this->detail = "Turno Activado";
        $this->paymentMethod = medio_pago::all();
    }

    public function dataSet($iden ,$idCalen , $name) 
    {
        $this->ide = $iden;
        $this->ideCalen = $idCalen;
        $this->namPac = $name;
        
    }
    public function resetData() 
    {
        $this->reset(['ideCalen' ,'ide', 'namPac']);
    }


    public function cancelCita()
    {
        try {
            
            db::table('citas')->where('id','=', $this->ide)->update(['status_id'=> 3,
                                                                    'pago_id' => 3
                                                                ]);
            db::table('calendarios_detalles')->where('id','=',  $this->ideCalen)->update(['stat_id' => 1]);
            $this->detail = "Turno Cancelado";

        } catch (\Throwable $th) {
            $this->alert ="#failAlt";
        }
    }

    public function closeModalAsign()
    {
        $this->emitTo('alta-reser-adm', '$render');
        $this->reset([     
            'inputTypeMethod',
            'inputOpNumber'
        ]);

        
    }

    public function activeDate()
    {
        try {
            db::table('citas')->where('id','=',$this->datTemp[0]['id'])->update(['nro_operacion_pago' => $this->inputOpNumber ,
                                                                            'status_id' => 1,
                                                                            'pago_id' => 2,
                                                                            'medio_id' => $this->inputTypeMethod
                                                                        ]);
        } catch (\Throwable $th) {
            $this->alert ="#failAlt";
        }
    }


    public function sendData( $data ) 
    {
        // $this->reset(['datTemp']);
        array_push($this->datTemp, json_decode( $data,true));
    }
    protected $listeners = ['render'];
    public function render()
    {
        $db= DB::table('citas')
                ->join('calendarios_detalles', 'citas.calendarios_deta_id','=','calendarios_detalles.id')
                ->join('calendarios_doctores','calendarios_detalles.calendarios_doctores_id','=','calendarios_doctores.id')
                ->join('doctores','calendarios_doctores.doctores_id','=','doctores.id')
                ->join('consultorios','calendarios_doctores.consultorios_id','=','consultorios.id')
                ->join('pacientes','citas.paciente_id','=','pacientes.id')
                ->join('personas','pacientes.persona_id','=', 'personas.id')
                ->join('citas_status','citas.status_id','=','citas_status.id')
                ->select('citas.id',DB::raw('CONCAT(personas.nombre," ", personas.apellido) as nombres'),'calendarios_detalles.dias_laborales', 'calendarios_detalles.horarios', 'citas_status.descripcion', 'personas.telefono_particular as telefono_paciente', db::raw('calendarios_detalles.id as idCalenDet'),
                        db::raw('(SELECT concat(personas.nombre," ", personas.apellido ) from personas where personas.id = doctores.persona_id) as doctor'),'doctores.telefono_laboral as telefono_doctor',
                        'consultorios.nombre as consul_nomb', 'consultorios.telefono as consult_telf', db::raw('(SELECT ciudades.descripcion from ciudades WHERE ciudades.id = consultorios.ciudad_id) as ciudad'), 'consultorios.map as ubi'
                        )
                ->where('citas_status.id','=',2)
                ->where('personas.cedula','LIKE', '%' . $this->searchCI . '%')
                ->whereRaw('CONCAT(personas.nombre," ", personas.apellido) LIKE ?', '%'. $this->search . '%')
                ->paginate($this->cant);
   
   
        return view('livewire.alta-reserva-admin', compact('db'));
    }
}
