<template>
<div class="panel panel-default">
    <div v-if="newPreg" class="panel-heading">
         <button class="btn btn-primary" v-on:click="onClickNewPregunta()">Agregar Pregunta</button>
    </div>
    <div v-else class="panel-body">
        <form action="" v-on:submit.prevent="newPregunta()">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="pregunta" v-model="descripcion" placeholder="Nueva Pregunta">
                    </div>
                    <div class="col-md-3">
                        <input type="number" class="form-control" name="tiempo" v-model="tiempo">
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
                descripcion: '',
                newPreg: true,
                tiempo:0
            }
        },
        mounted() {
            console.log('Component Form pregunta.')
        },
        methods:{
            newPregunta(){
                const params = {
                    descripcion: this.descripcion,
                    activa: false,
                    tiempo:this.tiempo
                };
                axios.post('/preguntas', params)
                    .then((response) => {
                        const pregunta = response.data;
                        this.$emit('newPregunta', pregunta);
                    });
                
                
                this.descripcion = '';
                this.tiempo = 0;
                this.newPreg = true;
            }, 
            onClickNewPregunta(){
                this.newPreg = false
            }
        }
    }
</script>
