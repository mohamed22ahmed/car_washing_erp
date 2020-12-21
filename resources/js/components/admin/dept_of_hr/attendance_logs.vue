<template>
    <div class="container">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                        <h3 class="card-title">{{ $t('140') }}</h3>
                            <div class="card-tools">
                            <div class="input-group mr-3">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-success">{{ $t('102') }}</button>
                                    <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu">
                                    <button class="dropdown-item" style="hover:light" @click="pullFromMachine">{{ $t('141') }}</button>
                                    <button class="dropdown-item" @click="takeEmpAttendance">{{ $t('142') }}</button>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-body table-responsive p-0">
                                <table class="table table-bordered table-hover text-center">
                                    <thead class="thead-light">
                                            <tr>
                                                <th>{{ $t('109') }}</th>
                                                <th>{{ $t('50') }}</th>
                                                <th>{{ $t('110') }}</th>
                                            </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Nada</td>
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
        </div>

        <div class="modal fade" id="pullFromMachine" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title w-100 font-weight-bold py-2" v-show="!editmode" id="addNewLabel">{{ $t('143') }}</h5>
                        <h5 class="modal-title w-100 font-weight-bold py-2" v-show="editmode" id="addNewLabel">{{ $t('143') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? updateUser() : createUser()">
                        <div class="modal-body">
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="machine">{{ $t('144') }}<span style="color:red;">*</span></label>
                                        <select name="machine" id="machine"  v-model="form.machine" class="form-control">
                                            <option value="-1">{{ $t('145') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">{{ $t('114') }}</button>
                            <button v-show="editmode" type="submit" class="btn btn-success">{{ $t('105') }}</button>
                            <button v-show="!editmode" type="submit" class="btn btn-primary">{{ $t('146') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="takeEmpAttendance" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title w-100 font-weight-bold py-2" v-show="!editmode" id="addNewLabel">{{ $t('147') }} 14/12/2020</h5>
                        <h5 class="modal-title w-100 font-weight-bold py-2" v-show="editmode" id="addNewLabel">{{ $t('147') }} 14/12/202</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? updateUser() : createUser()">
                         <div class="modal-body">
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="employee">{{ $t('50') }}<span style="color:red;">*</span></label>
                                        <select name="employee" id="employee" v-model="form.employee" class="form-control">
                                            <option value="-1">{{ $t('137') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">{{ $t('114') }}</button>
                            <button v-show="editmode" type="submit" class="btn btn-success">{{ $t('105') }}</button>
                            <button v-show="!editmode" type="submit" class="btn btn-primary">{{ $t('148') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: function() {
        return {
            editmode: false,
            form: new Form({
                machine:-1,
                employee:-1,
            }),
        }
    },
    methods: {
        // loadUsers: function() {
        //     axios.get("api/index").then((res) => {
        //         console.log(res.data)
        //     });
        // },

        pullFromMachine() {
            this.editmode = false;
            this.form.reset();
            $('#pullFromMachine').modal('show');
        },
        takeEmpAttendance() {
            this.editmode = false;
            this.form.reset();
            $('#takeEmpAttendance').modal('show');
        },

        pullFromMachine(user) {
            this.editmode = false;
            this.form.reset();
            $('#pullFromMachine').modal('show');
        },
        takeEmpAttendance(user) {
            this.editmode = false;
            this.form.reset();
            $('#takeEmpAttendance').modal('show');
        },
    },

    // created() {
    //     this.loadUsers();
    // },
}
</script>

