<template>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-7">
                    <input v-if="editModeP" type="text" class="form-control" v-model="pregunta.descripcion">
                    <input v-if="editModeP" type="number" class="form-control" v-model="pregunta.tiempo">
                    <p v-else>
                        <input v-if="pregunta.activa" checked="true" type="radio" :value="pregunta.activa" >
                        <input v-else type="radio" :value="!pregunta.activa" v-on:click="onClickActivarPregunta()" v-model="activar">
                        <strong>{{pregunta.descripcion}} - Tiempo: {{pregunta.tiempo}} seg</strong></p>
                    <hr>
                </div>
                <div class="col-md-5">
                    <button v-if="editModeP" class="btn btn-success" v-on:click="onClickUpdatePregunta()">Guardar</button>
                    <button v-else class="btn btn-warning" v-on:click="onClickEditPregunta()">Editar</button>
                    <button class="btn btn-danger" v-on:click="onClickDeletePregunta()">Eliminar</button>
                    <button v-if="!newResp" class="btn btn-info" v-on:click="onClickNewResp()">Nueva resp</button>
                </div>
                
            </div>
            <div v-if="newResp" class="row">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form action="" v-on:submit.prevent="newRespuesta()">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="respuesta" v-model="descripcionR"  placeholder="Nueva Respuesta">
                                        <input type="hidden" v-bind:value="pregunta.id" name="preguntaId" v-bind:id="pregunta.id"/>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary">Agregar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <respuestas-component
                v-for="(respuesta, index) in pregunta.respuestas" 
                :key="respuesta.id"
                :respuesta="respuesta"
                @deleteR="deleteRespuesta(index)"
                @updateR="updateRespuesta(index)">
                    
            </respuestas-component>         
        </div>
    </div>
                
</template>

<script>
    export default {
        props: [`pregunta`],
        data(){
            return{
                editModeP: false,
                newResp: false,
                respuestas: [],
                descripcionR: '',
                activar:false
            };
        },
        mounted() {
            console.log('Component Preguntas.')
            
        },
        methods:{
            //Gestion de Preguntas
            onClickDeletePregunta(){
                axios.delete(`/preguntas/${this.pregunta.id}`)
                    .then(() => {
                        this.$emit('deletePregunta');
                    });
            },
            onClickUpdatePregunta(){
                const params = {
                    descripcion: this.pregunta.descripcion,
                    tiempo: this.pregunta.tiempo
                };
                axios.put(`/preguntas/${this.pregunta.id}`, params)
                    .then((response) => {
                        this.editModeP = false;
                        const pregunta = response.data;
                        this.$emit('updatePregunta', pregunta);
                    });
            },
            onClickEditPregunta(){
                this.editModeP = true
            },
            //Gestion de eventos para respuestas
            updateRespuesta(index, respuesta){
                this.respuestas[index] = respuesta;
            },
            onClickNewResp(){
                this.newResp = true
            },
            addRespuesta(respuesta){
                this.newResp = false,
                this.respuestas.push(respuesta);
            },
            newRespuesta(){
                const params = {
                    descripcion: this.descripcionR,
                    pregunta: this.pregunta.id
                };
                console.info(params);
                axios.post('/respuestas', params)
                    .then((response) => {
                        const respuesta = response.data;
                        this.addRespuesta(respuesta);
                    });
                
                this.newResp = false,
                
                this.descripcionR = ''
            },
            deleteRespuesta(index){
                this.respuestas.splice(index, 1);
            },
            onClickActivarPregunta(){
                const params = {
                    pregunta: this.pregunta.id,
                    activar: !this.activar
                };
                console.info(params);
                axios.post('/preguntas/activar', params)
                    .then((response) => {
                        const pregunta = response.data;
                        this.$emit('updatePregunta', pregunta);
                    });
            }
        }
    }
</script>