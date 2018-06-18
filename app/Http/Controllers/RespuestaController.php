<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Respuesta;
use DB;

class RespuestaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    public function getRespuestas($id){
        $respuestas = Respuesta::where('pregunta_id', $id)->get();
        return $respuestas->toJson();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $respuesta = new Respuesta();
        $respuesta->descripcion = $request->descripcion;
        $respuesta->pregunta_id = $request->pregunta;
        //asignar letra
        $letras = Respuesta::where('pregunta_id', $request->pregunta)->pluck('letra')->toArray();
        $respuesta->letra = $this->getLetra($letras);
        $respuesta->save();
        return $respuesta;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $respuesta = Respuesta::find($id);
        $respuesta->descripcion = $request->descripcion;
        $respuesta->save();
        return $respuesta;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $respuesta = Respuesta::find($id);
        $respuesta->delete();
    }

    public function consulta(){
        $letras = Respuesta::where('pregunta_id', 1)->pluck('letra')->toArray();
        $this->getLetra($letras);
        dd($this->getLetra($letras));
        //dd($letras);
        //$letras = array("A", "B", "C", "D");
        
    }

    public function getLetra($letras){
        if (!in_array("A", $letras)) {
            return "A";
        }if (!in_array("B", $letras)) {
            return "B";
        }
        if (!in_array("C", $letras)) {
            return "C";
        }
        if (!in_array("D", $letras)) {
            return "D";
        }
    }

}
