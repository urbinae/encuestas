<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pregunta;
use App\Respuesta;
use DB;

class PreguntaController extends Controller
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
        $preguntas = Pregunta::with('respuestas')->where('user_id', auth()->id())->get();
        return $preguntas->toJson();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pregunta = new Pregunta();
        $pregunta->descripcion = $request->descripcion;
        $pregunta->activa = $request->activa;
        $pregunta->tiempo = $request->tiempo;
        $pregunta->user_id = auth()->id();
        $pregunta->save();
        return $pregunta;
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
        if ($request->activar) {
            # code...
        }
        $pregunta = Pregunta::find($id);
        $pregunta->descripcion = $request->descripcion;
        $pregunta->save();
        return $pregunta;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pregunta = Pregunta::find($id);
        DB::statement('SET FOREIGN_KEY_CHECKS = 0'); 
        $respuestas = Respuesta::where('pregunta_id', $id)->get();
        foreach ($respuestas as $respuesta) {
            $respuesta->delete();
        }
        $pregunta->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id identificador de la pregunta a activar
     * @return \Illuminate\Http\Response
     */
    public function activar(Request $request){
        $preguntas = Pregunta::all();
        //return $preguntas;
        foreach ($preguntas as $preg) {
            $preg->activa = false;
            $preg->save();
        }
        $pregunta = Pregunta::find($request->pregunta);
        $pregunta->activa = $request->activar;
        $pregunta->save();
        return $pregunta;
    }
}
