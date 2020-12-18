import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import Vuex from 'vuex'
import vuexI18n from 'vuex-i18n'
import router from './routes'
import storeData from './store/store.js'
import vSelect from 'vue-select'
import FlashMessage from '@smartweb/vue-flash-message';
import common from './common'

Vue.use(FlashMessage);
Vue.mixin(common)
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

const app = new Vue({
    el: '#app',
    store,
    router,
    created() {
        this.$store.dispatch("loaddictionary");
    }
});