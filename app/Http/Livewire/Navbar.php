<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Navbar extends Component
{   
    public $user;
    public function logGuest(){

        $id = User::where('email','=','guest@medicio.com')->first()->id;

        Auth::loginUsingId( $id );

        redirect()->route('reservar');
    }

    public function logUser(){

        redirect()->route('login');

    }


    public function render()
    {
    

        return view('livewire.navbar');
    }
}
