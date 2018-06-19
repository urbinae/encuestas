<template>
	<div class="row">
	    <div class="col-md-8 col-md-offset-2">
	        
            <form-preguntas-component
                @newPregunta="addPregunta">
            </form-preguntas-component>

	        <preguntas-component 
	        	v-for="(pregunta, index) in preguntas" 
	        	:key="pregunta.id"
	        	:pregunta="pregunta"
                @deletePregunta="deletePregunta(pregunta)"
                @updatePregunta="updatePregunta(pregunta)"
                @getPreguntas="getPreguntas()">
                
	        </preguntas-component>
	    </div>
	</div>

</template>

<script>
    export default {
    	data(){
    		return{
    			preguntas: [], 
    		}
    	},

        mounted() {
            console.log('Component encuestas.');
            this.getPreguntas();
        },

        methods:{
            getPreguntas(){
                console.log('----getPreguntas()');
                axios.get(`/preguntas`)
                .then((response) => {
                    this.preguntas = response.data;
                    console.info(this.preguntas);
                });
            },
        	addPregunta(pregunta){
        		//this.preguntas.push(pregunta);
                this.getPreguntas();
        	},
            updatePregunta(pregunta){
                //this.preguntas[index] = pregunta;
                const params = {
                    descripcion: pregunta.descripcion,
                    tiempo: pregunta.tiempo
                };
                axios.put(`/preguntas/`+pregunta.id, params)
                    .then((response) => {
                        //this.editModeP = false;
                        //const pregunta = response.data;
                        this.getPreguntas();
                    });
            },
            deletePregunta(pregunta){
                //this.preguntas.splice(index, 1);
                axios.delete(`/preguntas/`+pregunta.id)
                    .then(() => {
                        this.getPreguntas();
                });
            },
        }
    }
</script>
