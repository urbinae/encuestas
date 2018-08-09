<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Cronometro</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css" />

        <style>
            .row {
                margin: 24px 0;
            }

            #tiempo {
                font-size: 64px;
                text-align: center;
            }

            #lista-tiempos {
                font-size: 24px;
                list-style-type: none;
                border-top: 1px solid #ddd;
                border-bottom: 1px solid #ddd;
                margin: 24px 0;
                padding: 24px 0;
                text-align: center;
            }

            #lista-tiempos li {
                padding: 0;
                margin: 0;
            }

            #total {
                font-size: 24px;
                margin: 24px 0;
                text-align: center;
            }

            #total label {
                padding-right: 24px;
            }

            button.btn {
                display: block;
                width: 100%;
            }

            button:focus {
                outline: 0 none !important;
            }

            #boton-reiniciar {
                width: 45%;
                float: left;
            }

            #boton-agregar {
                width: 45%;
                float: right;
            }
        </style>
</head>
<body>
    <div id="app">
        <div class="container">
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <div id="tiempo">
                            <div>{{ tiempo | formateaTiempo }}</div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <button type="button" id="boton-empezar-parar" v-on:click="pulsa" class="btn btn-primary btn-lg">{{ contando ? 'Parar' : 'Empezar' }}</button>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <button type="button" id="boton-reiniciar" v-on:click="reinicia" class="btn btn-default btn-lg">Reiniciar</button>
                        <button type="button" id="boton-agregar" v-on:click="agregaTiempo" class="btn btn-default btn-lg" v-bind:disabled="(contando || tiempo == 0)">Agregar</button>
                    </div>
                </div>

                <div class="row" v-if="tiempos.length > 0">
                    <div class="col-md-4 col-md-offset-4">
                        <ul id="lista-tiempos">
                            <li v-for="tiempo in tiempos">{{ tiempo | formateaTiempo }}</li>
                        </ul>

                        <div id="total">
                            <label>Total</label><span>{{ totalTiempos() | formateaTiempo }}</span>
                        </div>

                        <button type="button" id="boton-borrar-tiempos" v-on:click="borrarTiempos" class="btn btn-danger btn-lg">Borrar todos</button>
                    </div>
                </div>
            </div>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="node_modules/vue/dist/vue.min.js"></script>
    <script type="text/javascript" src="node_modules/vue-localstorage/vue-localstorage.min.js"></script>
    <script type="text/javascript">
        (function() {

            'use strict';

            function pad(num, tam) {
                var s = num + '';

                while (s.length < tam) {
                    s = '0' + s;
                }

                return s;
            }
        });
    </script>

</body>
</html>
