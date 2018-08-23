<template>
	<div class="container">
	    <div class="flex-center">

	        <div class="content">
	            <div class="title">
	                Encuesta
	            </div>
	            <div class="panel panel-default">
	                <div class="panel-body">
	                	<form action="" v-on:submit.prevent="responder()">
		                    <div class="row" v-if="activa">
		                    	<div v-if="respondio">
		                    		Gracias por responder la pregunta <br> {{pregunta.descripcion}}
		                    	</div>
		                    	<div v-else>
		                    		{{pregunta.descripcion}} - {{pregunta.tiempo}} Seg.
		                        <div v-for="resp in pregunta.respuestas">
			                        <div class="radio">
			                          	<label>
			                          		<input type="radio" name="respuesta" v-bind:value="resp.letra" v-model="respuesta"> {{resp.letra}} - {{resp.descripcion}}
			                        	</label>
			                      </div> <br>
			                    </div>
			                    <div v-if="pregunta.respuestas.length">
			                    	<button class="btn btn-info">Enviar</button>
			                    </div>
		                    	</div>
		                    	 
		                    </div>
		                    <div class="row" v-else>
		                        No hay preguntas para responder
		                        
		                  	</div> 
	                  		
	                  	</form>
	              	</div>
	          	</div>
	          	
	      </div>
	  	</div>
	</div>
</template>

<script>
    export default {
        data(){
            return{
            	pregunta:null,
            	activa:true,
            	respuestas:[],
            	respuesta:'',
            	respondio:false
            };
        },
        mounted() {
            console.log('Component encuestados.');
            this.preguntaActiva();    
            
        },
        methods:{
            preguntaActiva(){
				const params = {                    
                };
                var aux;
	            axios.post(`/preguntas/activa`)
	                .then((response) => {
	                    aux = response.data.pregunta;
	                    if (aux != 0) {
	                    	this.pregunta = aux;
	                    	this.activa = true;
	                    	const params = {
			                    letra: this.respuesta,
			                    pregunta: this.pregunta.id,
			                    ip: $( "#ipadress" ).attr('value')                   
			                };
			                axios.post('/preguntas/responder', params)
			                    .then((response) => {
			                    	if (response.data==1) {
			                    		this.respondio = true
			                    	}
			                });
	                    } else {
	                    	this.activa = false;
	                    }
                });  
            },
            responder(){
            	if (this.respuesta == '') {
            		alert('Seleccione una respuesta');
            		return;
            	}
                const params = {
                    letra: this.respuesta,
                    pregunta: this.pregunta.id,
                    ip: $( "#ipadress" ).attr('value')                   
                };
                axios.post('/preguntas/responder', params)
                    .then((response) => {
                    	if (response.data==1) {
                    		this.respondio = true
                    		alert('Gracias por responder');
                    	}
                });
            }
        }
    };
</script>
