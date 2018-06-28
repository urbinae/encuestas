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
	$preguntas = Pregunta::where('activa', true)->get();
    return view('welcome', compact('preguntas'));
});

Auth::routes();

Route::get('/admin', 'HomeController@index')->name('admin');

Route::apiResource('preguntas', 'PreguntaController');
Route::apiResource('respuestas', 'RespuestaController');
Route::post('/preguntas/activar', 'PreguntaController@activar');
Route::post('/preguntas/desactivar', 'PreguntaController@desactivar');
Route::post('/preguntas/activa', 'PreguntaController@activa');
Route::get('consulta', 'RespuestaController@consulta');
