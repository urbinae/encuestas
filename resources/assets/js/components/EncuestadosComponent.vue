<template>
	<div class="container">
	    <div class="flex-center">

	        <div class="content">
	            <div class="title">
	                Encuesta
	            </div>
	            <div class="panel panel-default">
	                <div class="panel-body">
	                    <div class="row" v-if="!pregunta.activa">
	                        No hay pregunta para responder
	                    </div>
	                    <div class="row" @preguntaActual="preguntaActual()" v-else>
	                        {{pregunta.descripcion}} - {{pregunta.tiempo}} Seg.
	                        <div v-for="resp in pregunta.respuestas">
		                        <div class="radio">
		                          <label><input type="radio" name="optradio"> {{resp.letra}} - {{resp.descripcion}}</label>
		                      </div> <br>
		                    </div>
	                  </div> 
	                  <button class="btn btn-success">Enviar</button> 
	              	</div>
	          	</div>
	          	<pre>
	          		{{pregunta}}
	          	</pre>
	      </div>
	  	</div>
	</div>
</template>

<script>
    export default {
        data(){
            return{
            	pregunta:null,
            	activa:false,
            	respuestas:[]
            };
        },
        mounted() {
            console.log('Component encuestados.')
            this.pregunta = this.preguntaActiva();
        },
        methods:{
            preguntaActiva(){
				console.log('--Activa()---');
				const params = {                    
                };
	            axios.post(`/preguntas/activa`)
	                .then((response) => {
	                    this.pregunta = response.data.pregunta;
	                    console.info(this.pregunta);
	                    
                });                
            },
        }
    }
</script>
