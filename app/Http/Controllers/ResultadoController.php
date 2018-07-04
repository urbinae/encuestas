<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resultado;

class ResultadoController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        
    }

    public function getResultado($pregunta_id){
        $resultados = Resultado::where('pregunta_id', $pregunta_id)->get();
        return $resultados->toJson();
    }
}
