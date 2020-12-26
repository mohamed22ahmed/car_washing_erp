<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="modal fade" id="addNew" data-keyboard="false" data-backdrop="static">
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
                                                        <label for="employee">{{ $t('59') }}<span style="color:red;">*</span></label>
                                                        <select name="employee" id="employee" v-model="form.employee" class="form-control">
                                                            <option v-for="emp in employees" :key="emp.id" :value="emp.id">{{ emp.first_name }} {{emp.last_name}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-danger" data-dismiss="modal">{{ $t('114') }}</button>
                                            <button v-show="editmode" type="submit" class="btn btn-success" style="color:white;">{{ $t('105') }}</button>
                                            <button v-show="!editmode" type="submit" class="btn btn-primary" style="color:white;">{{ $t('148') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <form>
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">{{ $t('184') }}</a>
                                    <a class="nav-item nav-link" id="nav-job_info-tab" data-toggle="tab" href="#nav-job_info"  role="tab"  aria-controls="nav-job_info" aria-selected="false">{{ $t('185') }}</a>
                                    <a class="nav-item nav-link" id="nav-att_info-tab" data-toggle="tab" href="#nav-att_info" role="tab" aria-controls="nav-att_info" aria-selected="false">{{ $t('186') }}</a>
                                </div>
                            </nav>

                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row mt-4">
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label style="color:gray;">{{ $t('188') }}</label><br>
                                                            <span>#3</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-4">
                                                        <div class="form-group">
                                                           <label style="color:gray;">{{ $t('190') }}</label><br>
                                                           <span>6/12/2020 08:24</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                           <label style="color:gray;">{{ $t('191') }}</label><br>
                                                           <span>Car Wash</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label style="color:gray;">{{ $t('192') }}</label><br>
                                                            <span>2</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label style="color:gray;">{{ $t('19') }}</label><br>
                                                            <span>open</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="nav-job_info" role="tabpanel" aria-labelledby="nav-job_info-tab">
                                    <div class="container-fluid">
                                        <div class="row mt-3">
                                            <div class="col-12">
                                                <h5 class="mb-4 text-center">{{$t('193')}}</h5>
                                                <div class="card-body table-responsive p-0">
                                                    <table class="table table-bordered table-hover text-center">
                                                        <thead class="thead-light">
                                                                <tr>
                                                                    <th>{{ $t('109') }}</th>
                                                                    <th>{{ $t('59') }}</th>
                                                                    <th>{{ $t('187') }}</th>
                                                                    <th>{{ $t('188') }}</th>
                                                                    <th>{{ $t('189') }}</th>
                                                                    <th>{{ $t('18') }}</th>
                                                                    <th>{{ $t('110') }}</th>
                                                                </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>1</td>
                                                                <td>Nada</td>
                                                                <td>Nada</td>
                                                                <td>Nada</td>
                                                                <td>Nada</td>
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
                                        </div><hr>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="nav-att_info" role="tabpanel" aria-labelledby="nav-att_info-tab">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-12">
                                            <div class="card mt-3 bg-light">
                                                <div class="row ml-4">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label>Today</label><br>
                                                            <p>مدماك للكافيهات قام بإضافة جلسة حضور</p>&nbsp;
                                                              <span><i class="fas fa-clock"></i>&nbsp; 08:24:39</span>&nbsp;
                                                              <span><i class="fas fa-user"></i>&nbsp; Car Wash</span>&nbsp;
                                                              <span><i class="fas fa-home"></i>&nbsp; Root Branch</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['employee'],
    data: function(){
        return{
            logs:{},
            employees:[],
            form: new Form({
                id:'',
                employee:-1,
            })
        }
    },

    methods:{
        loadUsers(){
            axios.get('api/manage_emp/'+this.form.id).then((response)=>{
                this.logs=response.data
            });

            axios.get('api/get_all_employees').then((response)=>{
                this.employees=response.data
            });
        },

        updateProfile(e) {
            let file = e.target.files[0];
            let reader = new FileReader();
            let limit = 1024 * 1024 * 2;
            if (file['size'] > limit) {
                swal({
                    type: 'error',
                    title: 'Oops...',
                    text: 'You are uploading a large file',
                })
                return false;
            }
            reader.onloadend = (file) => {
                this.form.emp_picture = reader.result;
            }
            reader.readAsDataURL(file);
        },

        createUser(){
            this.$Progress.start();
            this.form.post('api/manage_emp').then(()=>{
                swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Employee Created successfully',
                    showConfirmButton: false,
                    timer: 1500
                })
            })
            this.$Progress.finish();
        },
        newModal() {
            this.editmode = false;
            this.form.reset();
            $('#addNew').modal('show');
        },
    },

    created() {
        this.form.id = this.$route.query.employee;
        this.loadUsers()
    },

    mounted() {
        this.newModal();
    },
}
</script>
