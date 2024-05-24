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
Vue.component('header-component', require('./components/HeaderComponent.vue').default);
Vue.component('filter-component', require('./components/FilterComponent.vue').default);

import lodash from 'lodash';
import VueLodash from 'vue-lodash';
Vue.use(VueLodash, { lodash: lodash })

import store from './store';

// Import the global CSS file
import '../css/app.css';

const app = new Vue({
    el: '#app',
    store,
});
