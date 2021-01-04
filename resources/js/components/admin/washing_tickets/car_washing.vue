<style scoped>
button {
    color: white;
}

.form-rounded {
    border-radius: 1rem;
}

.default {
    border-radius: 30px;
}

.form-control:focus {
    border-color: inherit;
    -webkit-box-shadow: none;
    box-shadow: none;
}

.verticalLine {
    border-left: thin solid black;
}
</style>

<template>
    <div class="container">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Car Wash Ticket</h3>
                            <div class="card-tools">
                                <button class="btn btn-success" @click="newModal">
                                    <i class="fas fa-plus fa-fw"></i>&nbsp; Add New Ticket
                                </button>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="card-body table-responsive p-0">
                                <table class="table table-bordered table-hover text-center">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>{{ $t('109') }}</th>
                                            <th>Client Name</th>
                                            <th>Num of Tickets</th>
                                            <th>Total Price</th>
                                            <th>Network value</th>
                                            <th>Cash Value</th>
                                            <th>Paid Up</th>
                                            <th>Residual</th>
                                            <th>{{ $t('110') }}</th>
                                        </tr>
                                    </thead>
                                    <!--<tbody>
                                        <tr v-for="role in roles.data" :key="role.id">
                                            <td>{{ role.id }}</td>
                                            <td>{{ role.name }}</td>
                                            <td>{{ role.name_ar }}</td>
                                            <td>
                                                <a href="#" @click="editRole(role)">
                                                    <i class="fa fa-edit red"></i>
                                                </a>&nbsp;/
                                                <a href="#" @click="deleteRole(role.id)">
                                                    <i class="fa fa-trash red"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>-->
                                </table>
                            </div>

                            <!--<div class="card-footer">
                                <pagination :data="roles" @pagination-change-page="getResults"></pagination>
                            </div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title d-flex justify-content-center" v-show="!editmode">Add New Ticket</h5>&nbsp;
                        <h5><span class="badge badge-pill badge-success">{{ form.client_status }}</span></h5>
                        <h5 class="modal-title" v-show="editmode" id="addNewLabel">Add New Ticket</h5>
                        <button type="button" class="close" style="color:black;" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form @submit.prevent="editmode ? updateTicket() : createTicket()">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <h5><span class="badge badge-pill badge-secondary">{{ form.serial_number }}</span></h5>
                                </div>

                                <div class="col-md-3">
                                    <input v-model="form.ticket_date" type="text" name="ticket_date" placeholder="ticket date" onfocus="(this.type='date')" class="form-control form-rounded" :class="{ 'is-invalid': form.errors.has('ticket_date') }">
                                    <has-error :form="form" field="ticket_date"></has-error>
                                </div>

                                <div class="col-md-1"></div>

                                <div class="col-md-3">
                                    <select class="form-control form-rounded" name="wash" v-model="form.wash">
                                        <option selected value="-1">Wash select</option>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <select class="form-control form-rounded" name="ticket_status" v-model="form.ticket_status">
                                        <option selected value="-1">Ticket Status</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-group col-md-2" style="border:1px groove gray;border-radius: 30px;">
                                        <input type="text" class="form-control" style="border:none" name="car_number_num_ar" v-model="form.car_number_num_ar">
                                        <div class="verticalLine"></div>
                                        <input type="text" class="form-control" style="border:none" name="car_number_letters_ar" v-model="form.car_number_letters_ar">
                                </div>
                                <div class="col-md-1 mt-5">
                                    <i class="fas fa-camera fa-2x"></i>
                                </div>

                                <div class="row col-md-2 mt-5">
                                    <select class="form-control form-rounded" name="color" v-model="form.color">
                                        <option v-for="colr in colors" :key="colr.sys_code" :value="colr.sys_code">{{ colr.name }}</option>
                                    </select>
                                </div>
                                <div class="col-md-1 mt-5" style="margin-left:-5px;">
                                    <button class="btn btn-sm btn-success default" type="button" @click="newCode_tableModal(1)">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>


                                <div class="col-md-2 mt-5">
                                    <select class="form-control form-rounded" name="brand" v-model="form.brand">
                                        <option v-for="brnd in brands" :key="brnd.sys_code" :value="brnd.sys_code">{{ brnd.name }}</option>
                                    </select>
                                </div>
                                <div class="col-md-1 mt-5" style="margin-left:-5px;">
                                    <button class="btn btn-sm btn-success default" type="button" @click="newCode_tableModal(2)">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>

                                <div class="col-md-2 mt-5">
                                    <select class="form-control form-rounded" name="car_status" v-model="form.car_status">
                                        <option v-for="car_st in car_status_all" :key="car_st.sys_code" :value="car_st.sys_code">{{ car_st.name }}</option>
                                    </select>
                                </div>
                                <div class="col-md-1 mt-5" style="margin-left:-5px;">
                                    <button class="btn btn-sm btn-success default" type="button" @click="newCode_tableModal(3)">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-2">
                                    <select class="form-control form-rounded" name="client" v-model="form.client">
                                        <option selected value="-1">select client</option>
                                    </select>
                                </div>
                                <div class="col-md-1 mt-1" style="margin-left:-7px; width">
                                    <button class="btn btn-sm btn-success default" type="button">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input v-model="form.phone" type="text" name="phone" placeholder="Phone Number" class="form-control form-rounded" :class="{ 'is-invalid': form.errors.has('phone') }">
                                        <has-error :form="form" field="phone"></has-error>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input v-model="form.enterance_date" type="text" name="enterance_date" onfocus="(this.type='date')" onblur="(this.type='text')" placeholder="Enterance Date" class="form-control form-rounded" :class="{ 'is-invalid': form.errors.has('enter_d`ate') }">
                                        <has-error :form="form" field="enterance_date"></has-error>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input v-model="form.exit_expected_date" type="text" name="exit_expected_date" onfocus="(this.type='date')" onblur="(this.type='text')" placeholder="Exit expected Date" class="form-control form-rounded" :class="{ 'is-invalid': form.errors.has('exit_date') }">
                                        <has-error :form="form" field="exit_expected_date"></has-error>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" class="btn btn-success default mr-3">save</button>
                            <button type="button" class="btn btn-success default mx-3" data-dismiss="modal">save & print</button>
                            <button type="button" class="btn btn-success default mx-3" data-dismiss="modal">update status</button>
                            <button type="button" class="btn btn-success default mx-3" data-dismiss="modal">add rate</button>
                            <button type="button" class="btn btn-success default mx-3" data-dismiss="modal">inform</button>
                            <button type="button" class="btn btn-danger default ml-3" data-dismiss="modal">{{ $t('114') }}</button>
                            <!--<button v-show="editmode" type="submit" class="btn btn-success">{{ $t('105') }}</button>
                                <button v-show="!editmode" type="submit" class="btn btn-primary">{{ $t('104') }}</button>-->
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="codeTableModal" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addNewLabel">Add New</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="createNew">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>English Name</label>
                                <input v-model="code_tableForm.sys_code_type" type="hidden" name="sys_code_type">
                                <input v-model="code_tableForm.name" type="text" name="name" placeholder="English Description" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Arabic Name</label>
                                <input v-model="code_tableForm.name_ar" type="text" name="name_ar" placeholder="الاسم بالعربية" class="form-control" dir="rtl">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Create</button>
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
            colors:{},
            brands:{},
            car_status_all:{},
            clients:{},
            form: new Form({
                id :'',
                serial_number :-1,
                ticket_date :new Date().toISOString().slice(0, 10),
                wash :-1,
                ticket_status :-1,
                car_number_num_ar :'',
                car_number_letters_ar :'',
                car_number_num_en :'',
                car_number_letters_en :'',
                color :-1,
                brand :-1,
                car_status :-1,
                client :-1,
                client_status :-1,
                phone :'',
                enterance_date :'',
                exit_expected_date:'',
            }),

            code_tableForm:new Form({
                sys_code_type:'',
                sys_code:'',
                name:'',
                name_ar:'',
            })
        }
    },

    methods: {
        get_serial(){
            axios.get('api/get_serial').then((res) => {
                this.form.serial_number = res.data;
            });
        },

        getResults() {
            axios.get('api/get_clients').then((res) => {
                this.clients = res.data;
            });
            axios.get('api/car_washing/1').then((res) => {
                this.colors=res.data
                this.form.color=res.data[0]['sys_code']
            });
            axios.get('api/car_washing/2').then((res) => {
                this.brands=res.data
                this.form.brand=res.data[0]['sys_code']
            });
            axios.get('api/car_washing/3').then((res) => {
                this.car_status_all=res.data
                this.form.car_status=res.data[0]['sys_code']
            });
        },

        getCodeTable() {
            axios.get('api/car_washing/' + this.code_tableForm.sys_code_type).then((res) => {
                if(this.code_tableForm.sys_code_type==1){
                    this.colors=res.data
                    this.form.color=res.data[0]['sys_code']
                }
                else if(this.code_tableForm.sys_code_type==2){
                    this.brands=res.data
                    this.form.brand=res.data[0]['sys_code']
                }
                else if(this.code_tableForm.sys_code_type==3){
                    this.car_status_all=res.data
                    this.form.car_status=res.data[0]['sys_code']
                }
            });
        },

        newModal() {
            this.editmode = false;
            this.form.reset();
            this.form.color=this.colors[0]['sys_code']
            this.form.brand=this.brands[0]['sys_code']
            this.form.car_status=this.car_status_all[0]['sys_code']
            this.get_serial()
            $('#addNew').modal('show');
        },

        openModal(){
            $('#addNew').modal('show');
        },

        newCode_tableModal(x){
            this.code_tableForm.reset();
            this.code_tableForm.sys_code_type=x
            $('#codeTableModal').modal('show');
        },

        createNew(){
            this.code_tableForm.post('api/car_washing_add_code_table').then(()=>{
                Fire.$emit('AfterCreateCode_table');
                $('#codeTableModal').modal('hide')
                swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Item Created successfully',
                    showConfirmButton: false,
                    timer: 1500
                })
                this.$Progress.finish();
            })
        },

        createTicket(){
            this.$Progress.start();
            this.form.post('api/car_washing').then(()=>{
                Fire.$emit('AfterCreate');
                $('#addNew').modal('hide')
                swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Role Created successfully',
                    showConfirmButton: false,
                    timer: 1500
                })
                this.$Progress.finish();
            })
        },

        editRole(user) {
            this.editmode = true;
            this.form.reset();
            $('#addNew').modal('show');
            this.form.fill(user);
        },

        // updateUser(){
        //     this.$Progress.start();
        //     this.form.put('api/roles/'+this.form.id).then(() => {
        //         $('#addNew').modal('hide');
        //         swal.fire(
        //             'Updated!',
        //             'Information has been updated.',
        //             'success'
        //         )
        //         this.$Progress.finish();
        //         Fire.$emit('AfterCreate');
        //     })
        //     .catch(() => {
        //         this.$Progress.fail();
        //     });
        // },

        // deleteRole(id){
        //     swal.fire({
        //         title: 'Are you sure?',
        //         text: "You won't be able to revert this!",
        //         type: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#3085d6',
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'Yes, delete it!'
        //     }).then((result) => {
        //         if (result.value) {
        //             this.form.delete('api/roles/'+id).then(()=>{
        //                 swal.fire(
        //                     'Deleted!',
        //                     'Role has been deleted.',
        //                     'success'
        //                 )
        //                 Fire.$emit('AfterCreate');
        //             }).catch(()=> {
        //                 swal.fire("Failed!", "This Role assigned to an employee.", "warning");
        //             });
        //         }
        //     })
        // },
    },

    created(){
        this.getResults();
        Fire.$on('AfterCreateCode_table',() => {
            this.getCodeTable();
        });
    }
}
</script>
