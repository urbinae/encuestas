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
                @deletePregunta="deletePregunta(index)"
                @updatePregunta="updatePregunta(index)">
                
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
            console.log('Component encuestas.')
            axios.get(`/preguntas`)
                .then((response) => {
                    this.preguntas = response.data;
                    //console.log(response.data);
                });
        },

        methods:{
        	addPregunta(pregunta){
        		this.preguntas.push(pregunta);
        	},
            updatePregunta(index, pregunta){
                this.preguntas[index] = pregunta;
            },
            deletePregunta(index){
                this.preguntas.splice(index, 1);
            },
        }
    }
</script>
