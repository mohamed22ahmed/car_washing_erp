import VueRoute from 'vue-router'

// finance
import jornals from './components/admin/finance/jornals'
import chart_of_account from './components/admin/finance/chart_of_account'

// Employees
import manage_emp from './components/admin/dept_of_hr/manage_employees/manage_emp'
import emp_infos_create from './components/admin/dept_of_hr/manage_employees/emp_infos_create'
import roles from './components/admin/dept_of_hr/manage_employees/roles'
import permission from './components/admin/dept_of_hr/manage_employees/permission'


import Vue from 'vue'
import { Form, HasError, AlertError } from 'vform'

const routes = [
    // finance module
    { name: 'jornals', path: '/jornals', component: jornals },
    { name: 'chart_of_account', path: '/chart_of_account', component: chart_of_account },

    // Employees
    { name: 'manage_emp', path: '/manage_emp', component: manage_emp },
    { name: 'emp_infos_create', path: '/emp_infos_create', component: emp_infos_create },
    { name: 'roles', path: '/roles', component: roles },
    { name: 'permission', path: '/permission', component: permission },
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