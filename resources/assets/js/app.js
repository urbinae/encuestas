
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('encuesta-component', require('./components/EncuestaComponent.vue'));
Vue.component('form-preguntas-component', require('./components/FormPreguntasComponent.vue'));
Vue.component('preguntas-component', require('./components/PreguntasComponent.vue'));
Vue.component('respuestas-component', require('./components/RespuestasComponent.vue'));
Vue.component('form-respuestas-component', require('./components/FormRespuestasComponent.vue'));
Vue.component('encuestados-component', require('./components/EncuestadosComponent.vue'));

const app = new Vue({
    el: '#app'
});
