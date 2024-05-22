require('./bootstrap');
import Vue from 'vue';

// bootstrap
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
import 'bootstrap-vue/dist/bootstrap-vue.css';
import 'bootstrap/dist/css/bootstrap.css';
Vue.use(BootstrapVue);
Vue.use(IconsPlugin);

// vue-select
import vSelect from 'vue-select';
import 'vue-select/dist/vue-select.css';
Vue.component('v-select', vSelect)

// component
// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('excel-data-component', require('./components/ExcelDataComponent.vue').default);
Vue.component('main-menu', require('./components/MainMenu.vue').default);

const app = new Vue({
    el: '#app',
});
