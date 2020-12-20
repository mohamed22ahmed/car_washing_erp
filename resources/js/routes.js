import VueRoute from 'vue-router'

// finance
import jornals from './components/admin/finance/jornals'
import chart_of_account from './components/admin/finance/chart_of_account'

// Employees
import manage_emp from './components/admin/dept_of_hr/manage_employees/manage_emp'
import emp_infos_create from './components/admin/dept_of_hr/manage_employees/emp_infos_create'
import roles from './components/admin/dept_of_hr/manage_employees/roles'
import permission from './components/admin/dept_of_hr/manage_employees/permission'

import tag_setup from './components/Setup/tag_setup'
import jornals from './components/admin/finance/jornals.vue'
import chart_of_account from './components/admin/finance/chart_of_account.vue'
import manage_role from './components/admin/dept_of_hr/manage_role.vue'
import organizational_structure from './components/admin/dept_of_hr/organizational_structure.vue'
import attendance_logs from './components/admin/dept_of_hr/attendance_logs.vue'
import manage_emp from './components/admin/dept_of_hr/manage_employees/manage_emp.vue'
import emp_infos_create from './components/admin/dept_of_hr/manage_employees/emp_infos_create.vue'
import attendance_permissions from './components/admin/dept_of_hr/attendance/attendance_permissions.vue'
import shift_management from './components/admin/dept_of_hr/attendance/shift_management.vue'
import settings from './components/admin/dept_of_hr/settings/settings.vue'
import holiday_lists from './components/admin/dept_of_hr/settings/holiday_lists.vue'
import attendance_flag from './components/admin/dept_of_hr/settings/attendance_flag.vue'
import machines from './components/admin/dept_of_hr/settings/machines.vue'
import leave_policies from './components/admin/dept_of_hr/settings/leave_policies.vue'

import Vue from 'vue'
import { Form, HasError, AlertError } from 'vform'

const routes = [
    // finance module
    { name: 'jornals', path: '/jornals', component: jornals },
    { name: 'chart_of_account', path: '/chart_of_account', component: chart_of_account },
    { name: 'manage_role', path: '/manage_role', component: manage_role },
    { name: 'organizational_structure', path: '/organizational_structure', component: organizational_structure },
    { name: 'attendance_logs', path: '/attendance_logs', component: attendance_logs },
    { name: 'manage_emp', path: '/manage_emp', component: manage_emp },
    { name: 'emp_infos_create', path: '/emp_infos_create', component: emp_infos_create },
    { name: 'attendance_permissions', path: '/attendance_permissions', component: attendance_permissions },
    { name: 'shift_management', path: '/shift_management', component: shift_management },
    { name: 'settings', path: '/settings', component: settings },
    { name: 'holiday_lists', path: '/holiday_lists', component: holiday_lists },
    { name: 'attendance_flag', path: '/attendance_flag', component: attendance_flag },
    { name: 'machines', path: '/machines', component: machines },
    { name: 'leave_policies', path: '/leave_policies', component: leave_policies },
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
