<template>
    <div class="row">
        <div class="col-md-8">
            <input v-if="editModeR" type="text" class="form-control" v-model="respuesta.descripcion">
            <p v-else>{{respuesta.letra}} - {{respuesta.descripcion}}</p>
        </div>
        <div class="col-md-4">
            <button v-if="editModeR" class="btn btn-success" v-on:click="onClickUpdateRespuesta()">Guardar</button>
            <button v-else class="btn btn-warning" v-on:click="onClickEditRespuesta()">Editar</button>
            <button class="btn btn-danger" v-on:click.prevent="onClickDeleteRespuesta(respuesta)">Eliminar</button>
        </div>

    </div>
</template>

<script>
    export default {
        props: [`respuesta`],
        data(){
            return{
                editModeR: false,
                preguntas: []
            };
        },

        mounted() {
            console.log('Component respuestas.')
        },
        methods:{
            getPreguntas(){
                axios.get(`/preguntas`)
                .then((response) => {
                    this.preguntas = response.data;
                    //console.log(response.data);
                });
            },
            onClickDeleteRespuesta(){
                this.$emit('deleteR');                
                
            },
            onClickUpdateRespuesta(){
                const params = {
                    descripcion: this.respuesta.descripcion,
                    pregunta_id: this.respuesta.pregunta_id
                };
                axios.put(`/respuestas/${this.respuesta.id}`, params)
                    .then((response) => {
                        this.editModeR = false;
                        const respuesta = response.data;
                        this.$emit('updateR', respuesta);
                    });
            },
            onClickEditRespuesta(){
                this.editModeR = true
            }
        }
    }
</script>
