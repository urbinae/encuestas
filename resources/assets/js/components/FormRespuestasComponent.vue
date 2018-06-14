<template>
<div class="panel panel-default">
    
    <div class="panel-body">
        <form action="" v-on:submit.prevent="newRespuesta()">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="respuesta" v-model="descripcionR"  placeholder="Nueva Respuesta">
                        <input type="text" v-bind:value="pregunta.descripcion"/>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">Agregar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
                
</template>

<script>
    export default {
        data(){
            return{
                descripcionR: '',
                preguntaR: this.pregunta
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods:{
            newRespuesta(){
                const params = {
                    descripcion: this.descripcionR,
                    pregunta:this.preguntaR
                };
                console.info(params);
                axios.post('/respuestas', params)
                    .then((response) => {
                        const respuesta = response.data;
                        this.$emit('newRespuesta', respuesta);
                    });
                
                
                this.descripcionR = ''
            }
        }
    }
</script>
