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
                                <tr>
                                    <td>1</td>
                                    <td>Nada</td>
                                    <td>nada@email.com</td>
                                    <td>
                                        <a href="#" @click="editModal(code_table)">
                                            <i class="fa fa-edit blue"></i>
                                        </a>
                                        /
                                        <a href="#" @click="deleteUser(code_table.sys_code,code_table.sys_code_type)">
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
        }
    },
    methods: {
        // loadUsers: function() {
        //     axios.get("api/index").then((res) => {
        //         console.log(res.data)
        //     });
        // },
    },

    // created() {
    //     this.loadUsers();
    // },
}
</script>
