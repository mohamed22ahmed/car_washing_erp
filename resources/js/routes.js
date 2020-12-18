import VueRoute from 'vue-router'


import tag_setup from './components/Setup/tag_setup'
import jornals from './components/admin/finance/jornals.vue'
import chart_of_account from './components/admin/finance/chart_of_account.vue'
import manage_role from './components/admin/dept_of_hr/manage_role.vue'
import manage_emp from './components/admin/dept_of_hr/manage_employees/manage_emp.vue'
import emp_infos_create from './components/admin/dept_of_hr/manage_employees/emp_infos_create.vue'

import Vue from 'vue'
import { Form, HasError, AlertError } from 'vform'

const routes = [
    { name: 'tag_setup', path: '/tag_setup', component: tag_setup },
    { name: 'jornals', path: '/jornals', component: jornals },
    { name: 'chart_of_account', path: '/chart_of_account', component: chart_of_account },
    { name: 'manage_role', path: '/manage_role', component: manage_role },
    { name: 'manage_emp', path: '/manage_emp', component: manage_emp },
    { name: 'emp_infos_create', path: '/emp_infos_create', component: emp_infos_create },
]


window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.component('pagination', require('laravel-vue-pagination'))

Vue.use(VueRoute);

const router = new VueRoute({
    routes,
    mode: 'history'

});

export default router
