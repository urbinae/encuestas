<?php
 use App\Pregunta;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	$pregunta = Pregunta::where('activa', true)->get()[0]	;
	//dd($pregunta);
    return view('welcome', compact('pregunta'));
});

Auth::routes();

Route::get('/admin', 'HomeController@index')->name('admin');

Route::apiResource('preguntas', 'PreguntaController');
Route::apiResource('respuestas', 'RespuestaController');
Route::post('/preguntas/activar', 'PreguntaController@activar');
Route::get('consulta', 'RespuestaController@consulta');
