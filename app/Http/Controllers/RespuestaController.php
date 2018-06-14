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

}
