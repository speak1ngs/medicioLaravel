<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function crear()
    {
        return view('crear-post');
    }

    public function alta()
    {
        return view('alta-post');
    }
}
