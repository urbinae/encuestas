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

    public function grafica(Request $req){
        //return view('graph');
        $resultados = Resultado::where('pregunta_id', $req->pregunta)->get();
        $A = 0;
        $B = 0;
        $C = 0;
        $D = 0;
        foreach ($resultados as $value) {
            if ($value->letra == 'A') {
                $A++;
            }
            if ($value->letra == 'B') {
                $B++;
            }
            if ($value->letra == 'C') {
                $C++;
            }
            if ($value->letra == 'D') {
                $D++;
            }
        }
        return response()->json([
            'letras' => ['A', 'B', 'C', 'D'],
            'cant'   => [$A, $B, $C, $D]
        ]);
    }
    
}
