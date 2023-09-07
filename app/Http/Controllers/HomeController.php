<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //

    public function __invoke()
    {   
            $val = DB::table('model_has_roles')->where('model_id','=', Auth::id())->select('role_id')->get();
            $role =DB::table('roles')->where('id','=',$val[0]->role_id)->get('name');

            foreach($role as $rol){
                switch ($rol->name) {
                    case 'Doctor':
                        return redirect('doctor/agenda');
                        break;
                        case 'Admin':
                            return redirect('admfunc/reservar-adm');
                            break;
                            case 'Paciente':
                                return redirect('paciente/reservar');
                                break;
                                case 'Invitado':
                                    return redirect('paciente/reservar');
                                    break;
                        
                    default:
                        return redirect('/');
                        break;
                }
            }
    }
}
