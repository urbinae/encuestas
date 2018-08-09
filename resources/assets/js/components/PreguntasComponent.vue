<template>
    <div class="panel panel-info">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-5">
                    <div v-if="editModeP">
                        <input type="text" class="form-control" v-model="pregunta.descripcion">
                        <input type="number" class="form-control" v-model="pregunta.tiempo">
                    </div>
                    <div v-else>
                    <p>
                        <div v-if="pregunta.activa" >
                             <button class="btn btn-danger" v-on:click="desactivarPregunta(pregunta)">Desactivar</button>
                        </div>
                        <div v-else>
                             <button class="btn btn-success" v-on:click="activarPregunta(pregunta)">Activar</button> 
                        </div>
                        <strong>{{pregunta.descripcion}}- {{pregunta.tiempo}} Seg.</strong></p>
                    </div>
                    <hr>
                </div>
                <div class="col-md-7">
                    <button v-if="editModeP" class="btn btn-success" v-on:click="onClickUpdatePregunta()" title="Guardar">Guardar</button>
                    <button v-else class="btn btn-warning" v-on:click="onClickEditPregunta()" title="Editar">Editar</button><i class="fa fa-edit"></i>
                    <button class="btn btn-danger" v-on:click.prevent="onClickDeletePregunta(pregunta)" title="Eliminar">Eliminar</button>
                    <button v-if="!newResp" class="btn btn-info" v-on:click="onClickNewResp()" title="Agregar respuesta">+ resp</button>
                    <button class="btn btn-success" v-on:click="graficar(pregunta)" title="Graficar">Graficar</button>
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
                @deleteR="deleteRespuesta(respuesta)"
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
                activar:true
            };
        },
        mounted() {
            console.log('Component Preguntas.')
            //this.$emit('getPreguntas');
            
        },
        methods:{
            //Gestion de Preguntas
            onClickDeletePregunta(pregunta){
                this.$emit('deletePregunta', pregunta);
                
            },
            onClickUpdatePregunta(){
                this.$emit('updatePregunta');
                this.editModeP = false;                
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
                
                //this.respuestas.push(respuesta);
            },
            newRespuesta(){
                this.newResp = false;
                const params = {
                    descripcion: this.descripcionR,
                    pregunta: this.pregunta.id
                };
                console.info(params);
                axios.post('/respuestas', params)
                    .then((response) => {
                        //const respuesta = response.data;
                        //this.addRespuesta(respuesta);
                        this.$emit('getPreguntas');
                    });
                
                this.newResp = false,
                
                this.descripcionR = ''
            },
            deleteRespuesta(respuesta){
                axios.delete(`/respuestas/`+respuesta.id)
                    .then(() => {
                        this.$emit('getPreguntas');
                    });
            },
            activarPregunta(pregunta){
                const params = {
                    pregunta: pregunta.id,
                    activar: true
                };
                console.info(params);
                axios.post('/preguntas/activar', params)
                    .then((response) => {
                        this.$emit('getPreguntas');
                        this.$emit('preguntaActual', pregunta);
                        //EventBus.$emit('activar', pregunta);
                    });
            },
            desactivarPregunta(pregunta){
                const params = {
                    pregunta: pregunta.id,
                    desactivar: false
                };
                console.info(params);
                axios.post('/preguntas/desactivar', params)
                    .then((response) => {
                        this.$emit('getPreguntas');
                    });
            },
            graficar(pregunta){
               const params = {
                    pregunta: pregunta.id,
                    desactivar: false
                };
                location.href = '/  '; 
            }
        }
    }
</script>