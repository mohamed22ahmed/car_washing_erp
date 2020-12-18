import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import Vuex from 'vuex'
import vuexI18n from 'vuex-i18n'
import router from './routes'
import storeData from './store/store.js'
import vSelect from 'vue-select'
import FlashMessage from '@smartweb/vue-flash-message';


Vue.use(FlashMessage);

require('./bootstrap');

window.Vue = require('vue');
Vue.use(Vuex);


const store = new Vuex.Store(storeData);

Vue.use(vuexI18n.plugin, store);
const translationsDe = {
    "My nice title": "Ein schöner Titel",
    "content": "Dies ist ein toller Inhalt"
};


Vue.i18n.set(default_locale_lang);


window.Fire = new Vue();


import swal from 'sweetalert2'
window.swal = swal


import VueProgressBar from 'vue-progressbar'

Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '3px'
})

Vue.use(Vuetify);
const opts = {}
export default new Vuetify(opts)

Vue.component('v-select', vSelect)
Vue.component('table_editable', require('./components/TableEditable.vue').default);
Vue.component('jornals', require('./components/admin/finance/jornals.vue').default);
Vue.component('chart_of_account', require('./components/admin/finance/chart_of_account.vue').default);
Vue.component('manage_role', require('./components/admin/dept_of_hr/manage_role.vue').default);
Vue.component('manage_emp', require('./components/admin/dept_of_hr/manage_employees/manage_emp.vue').default);
Vue.component('emp_infos_create', require('./components/admin/dept_of_hr/manage_employees/emp_infos_create.vue').default);

const app = new Vue({
    el: '#app',
    store,
    router,
});
