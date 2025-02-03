<?php

namespace App\Http\Controllers;

use App\Models\DocumentoExpediente;
use App\Models\Expediente;
use App\Models\PersonaJuridica;
use App\Models\PersonaNatural;
use App\Models\RepresentanteLegal;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index(){
        return view('home');
    }
}
