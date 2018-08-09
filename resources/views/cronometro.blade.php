@extends('layouts.app')

@section('content')
<div class="container">
    <encuesta-component></encuesta-component>
</div>
@endsection





<!DOCTYPE html>
<html>
    
    <body>

        <div id="app">
            
        </div>

        
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

                Vue.use(VueLocalStorage);

                var app = new Vue({
                    el: '#app',
                    data: {
                        tiempo: 0,
                        contando: false,
                        tiempos: []
                    },
                    created: function() {
                        var tiempos = this.$localStorage.get('tiempos');
                        if(tiempos === null || tiempos === '') {
                            this.tiempos = [];
                        }
                        else {
                            tiempos = tiempos.split(',');
                            for(var i = 0; i < tiempos.length; i++) {
                                tiempos[i] = parseInt(tiempos[i]);
                            }
                            this.tiempos = tiempos;
                        }

                        setInterval(this.actualizaTiempo, 1000);
                    },
                    methods: {
                        tiempoFormateado: function() {
                            return formateaTiempo(this.tiempo);
                        },
                        actualizaTiempo: function() {
                            if(this.contando) {
                                this.tiempo++;
                            }
                        },
                        pulsa: function() {
                            this.contando = !this.contando;
                        },
                        reinicia: function() {
                            this.tiempo = 0;
                        },
                        agregaTiempo: function() {
                            this.tiempos.push(this.tiempo);
                            this.tiempo = 0;

                            this.$localStorage.set('tiempos', this.tiempos);
                        },
                        borrarTiempos: function() {
                            this.tiempos.splice(0, this.tiempos.length);

                            this.$localStorage.set('tiempos', this.tiempos);
                        },
                        totalTiempos: function() {
                            var total = 0;

                            for(var i = 0; i < this.tiempos.length; i++) {
                                total += this.tiempos[i];
                            }

                            return total;
                        }
                    },
                    filters: {
                        formateaTiempo: function(t) {
                            var horas = parseInt(t / 3600);
                            var minutos = parseInt(t / 60) % 60;
                            var segundos = t % 60;
                            var s = pad(horas, 2) + ':' + pad(minutos, 2) + ':' + pad(segundos, 2);

                            return s;
                        }
                    }
                })

            });
        </script>
    </body>
</html>
