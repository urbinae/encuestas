<template>
	
</template>

<script>
    export default {
        data(){
            return{
                tiempo: 0,
                contando: false,
                tiempos: [] 
            }
        },
        mounted() {
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

        methods:{
           tiempoFormateado() {
            return formateaTiempo(this.tiempo);
        },
        actualizaTiempo() {
            if(this.contando) {
                this.tiempo++;
            }
        },
        pulsa() {
            this.contando = !this.contando;
        },
        reinicia() {
            this.tiempo = 0;
        },
        agregaTiempo() {
            this.tiempos.push(this.tiempo);
            this.tiempo = 0;

            this.$localStorage.set('tiempos', this.tiempos);
        },
        borrarTiempos() {
            this.tiempos.splice(0, this.tiempos.length);

            this.$localStorage.set('tiempos', this.tiempos);
        },
        totalTiempos() {
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
    }
</script>
