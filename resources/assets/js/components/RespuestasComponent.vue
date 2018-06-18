<template>
    <div class="row">
        <div class="col-md-8">
            <input v-if="editModeR" type="text" class="form-control" v-model="respuesta.descripcion">
            <p v-else>{{respuesta.letra}}-{{respuesta.descripcion}}</p>
        </div>
        <div class="col-md-4">
            <button v-if="editModeR" class="btn btn-success" v-on:click="onClickUpdateRespuesta()">Guardar</button>
            <button v-else class="btn btn-warning" v-on:click="onClickEditRespuesta()">Editar</button>
            <button class="btn btn-danger" v-on:click="onClickDeleteRespuesta()">Eliminar</button>
        </div>

    </div>
</template>

<script>
    export default {
        props: [`respuesta`],
        data(){
            return{
                editModeR: false
            };
        },
        mounted() {
            console.log('Component respuestas.')
        },
        methods:{
            onClickDeleteRespuesta(){
                axios.delete(`/respuestas/${this.respuesta.id}`)
                    .then(() => {
                        this.$emit('deleteR');
                    });
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
