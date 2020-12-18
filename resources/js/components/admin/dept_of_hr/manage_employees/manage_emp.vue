<template>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header font-weight-bold">Employees List
                        <div class="card-tools">
                            <router-link :to="{ path: '/emp_infos_create'}" class="btn btn-success">
                                <i class="fas fa-user-plus fa-fw"></i>&nbsp; Add Employee
                            </router-link>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-bordered table-responsive-md text-center">
                            <thead class="thead-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Modify</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="employee in employees.data" :key="employee.id">
                                    <td>{{ employee.id }}</td>
                                    <td>{{ employee.first_name }}</td>
                                    <td>{{ employee.email }}</td>
                                    <td>
                                        <router-link :to="{ path: '/emp_infos_create?employee='+employee.id}">
                                            <i class="fa fa-edit blue"></i>
                                        </router-link>&nbsp;&nbsp;/
                                        <a href="#" @click="deleteEmployee(employee.id)">
                                            <i class="fa fa-trash red"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: function() {
        return {
            employees:{},
        }
    },
    methods: {
        loadUsers: function() {
            axios.get("api/manage_emp").then((res) => {
                this.employees=res.data
            });
        },

        deleteEmployee(id){
            swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    axios.get('api/manage_emp_delete/'+id).then(()=>{
                        swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                        Fire.$emit('AfterCreate');
                    }).catch(()=> {
                        swal.fire("Failed!", "There was something wronge.", "warning");
                    });
                }
            })
        },
    },

    created() {
        this.loadUsers();
        Fire.$on('AfterCreate',() => {
            this.loadUsers();
        });
    },
}
</script>
