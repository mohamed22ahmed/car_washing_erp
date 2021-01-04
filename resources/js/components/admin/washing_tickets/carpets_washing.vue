<style scoped>
button{
    color:white;
}
.form-rounded {
    border-radius: 1rem;
}
.default{
    border-radius: 20px;
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
                            <h3 class="card-title">{{ $t('201') }}</h3>
                            <div class="card-tools">
                                <button class="btn btn-success" @click="newModal">
                                <i class="fas fa-plus fa-fw"></i>&nbsp; {{ $t('202') }}</button>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="card-body table-responsive p-0">
                                <table class="table table-bordered table-hover text-center">
                                <thead class="thead-light">
                                    <tr>
                                        <th>{{ $t('109') }}</th>
                                        <th>{{ $t('194') }}</th>
                                        <th>{{ $t('195') }}</th>
                                        <th>{{ $t('196') }}</th>
                                        <th>{{ $t('197') }}</th>
                                        <th>{{ $t('205') }}</th>
                                        <th>{{ $t('199') }}</th>
                                        <th>{{ $t('110') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="carpet in carpets.data" :key="carpet.id">
                                        <td>{{ carpet.id }}</td>
                                        <td>{{ carpet.client }}</td>
                                        <td>{{ carpet.id }}</td>
                                        <td>{{ carpet.num_of_materials }}</td>
                                        <td>{{ carpet.total_price }}</td>
                                        <td>{{ carpet.ticket_status }}</td>
                                        <td>{{ carpet.ticket_date }}</td>
                                        <td>
                                            <a href="#" @click="editRole(carpet)">
                                                <i class="fa fa-edit red"></i>
                                            </a>&nbsp;/
                                            <a href="#" @click="deleteRole(carpet.id)">
                                                <i class="fa fa-trash red"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                            <div class="card-footer">
                                <pagination :data="carpets" @pagination-change-page="getResults"></pagination>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-center">
                        <span class="badge badge-pill badge-success">good client</span>
                        <button type="button" class="close" style="color:black;" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form @submit.prevent="editmode ? updateUser() : createUser()">
                        <div class="modal-body">
                           <div class="row">
                                <div class="col-md-2">
                                   <h5><span class="badge badge-pill badge-secondary">12000002536</span></h5>
                                </div>

                                <div class="col-md-3">
                                    <input v-model="form.ticket_date" type="text" name="ticket_date" :placeholder="ticket_date" onblur="(this.type='text')" onfocus="(this.type='date')" class="form-control form-rounded" :class="{ 'is-invalid': form.errors.has('ticket_date') }">
                                    <has-error :form="form" field="ticket_date"></has-error>
                                </div>

                                <div class="col-md-1"></div>

                                <div class="col-md-3">
                                   <select class="form-control form-rounded" name="wash" v-model="form.wash">
                                        <option selected value="-1">{{$t('204')}}</option>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                     <select class="form-control form-rounded" name="ticket_status" v-model="form.ticket_status">
                                        <option selected value="-1">{{$t('205')}}</option>
                                    </select>
                                </div>
                           </div>

                           <div class="row mt-3">
                                <div class="col-md-2">
                                   <select class="form-control form-rounded" name="client" v-model="form.client">
                                        <option selected value="-1">{{$t('206')}}</option>
                                    </select>
                                </div>
                                <div class="col-md-1 mt-1" style="margin-left:-7px; width">
                                    <button class="btn btn-sm btn-success default">
                                    <i class="fas fa-plus"></i></button>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input v-model="form.phone_number" type="text" name="phone_number" :placeholder="phone_number" class="form-control form-rounded" :class="{ 'is-invalid': form.errors.has('phone_number') }">
                                        <has-error :form="form" field="phone_number"></has-error>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                   <select class="form-control form-rounded" name="carpet_size" v-model="form.carpet_size">
                                        <option selected value="-1">{{$t('208')}}</option>
                                    </select>
                                </div>
                                <div class="col-md-1 mt-1" style="margin-left:-7px; width">
                                    <button class="btn btn-sm btn-success default">
                                    <i class="fas fa-plus"></i></button>
                                </div>

                                <div class="col-md-2">
                                   <select class="form-control form-rounded" name="wash_type" v-model="form.wash_type">
                                        <option selected value="-1">{{ $t('209') }}</option>
                                    </select>
                                </div>
                                <div class="col-md-1 mt-1" style="margin-left:-7px; width">
                                    <button class="btn btn-sm btn-success default">
                                    <i class="fas fa-plus"></i></button>
                                </div>
                           </div>


                            <div class="row mt-3  d-flex justify-content-center">
                                <div class="col-md-10">
                                    <div class="card card-default">
                                        <div class="card-body">
                                            <div class="table-responsive p-0">
                                                <form @submit.prevent="createUser()">
                                                    <table class="table text-center">
                                                        <thead>
                                                            <tr>
                                                                <th>{{ $t('229') }}</th>
                                                                <th>{{ $t('227') }}</th>
                                                                <th>{{ $t('228') }}</th>
                                                                <th>{{ $t('230') }}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td><input  type="text"    class="form-control"   name="name"></td>
                                                                <td><input  type="number"  class="form-control"   name="units"></td>
                                                                <td><input  type="number"  class="form-control"   name="cost"></td>
                                                                <td><button type="submit" class="btn btn-sm btn-info">{{$t('133')}}</button></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </form>
                                            </div>
                                        </div>
                                        <!--<table class="table text-center">
                                            <tbody v-for="unit in units.data" :key="unit.id">
                                                <tr>
                                                    <td>{{unit.name}}</td>
                                                    <td>{{unit.units}}</td>
                                                    <td>{{unit.cost}}</td>
                                                    <td>
                                                        <a href="#" @click="deleteMaterial(unit.id)">
                                                            <i class="fa fa-trash" style="color:red;"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>-->
                                    </div>
                                </div>
                            </div>

                           <div class="row mt-3">
                                <div class="col-md-2"></div>

                                <div class="col-md-4">
                                    <input v-model="form.receipt_date" type="text" name="Time of receipt" :placeholder="entrance_date" onblur="(this.type='text')" onfocus="(this.type='date')" class="form-control form-rounded" :class="{ 'is-invalid': form.errors.has('receipt_date') }">
                                    <has-error :form="form" field="receipt_date"></has-error>
                                </div>

                                <div class="col-md-4">
                                    <input v-model="form.expected_exit_date" type="text" name="expected_exit_date" :placeholder="expected_exit_date" onblur="(this.type='text')" onfocus="(this.type='date')" class="form-control form-rounded" :class="{ 'is-invalid': form.errors.has('expected_exit_date') }">
                                    <has-error :form="form" field="expected_exit_date"></has-error>
                                </div>
                           </div>

                            <!--<div class="row mt-3">
                                <button class="btn btn-sm btn-success default ml-2">
                                <i class="fas fa-plus"></i>&nbsp; Add New Line</button>

                                <div class="card-body table-responsive p-0 d-flex justify-content-center">
                                    <table class="table table-bordered table-hover text-center" style="width:auto;">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>{{ $t('109') }}</th>
                                            <th>Client Name</th>
                                            <th>Size</th>
                                            <th>Type</th>
                                            <th>Wash</th>
                                            <th>Status</th>
                                            <th>{{ $t('110') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
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
                                    </tbody>
                                    </table>
                                </div>
                            </div>-->
                        </div>

                        <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" class="btn btn-success default mr-3">{{ $t('121') }}</button>
                            <button type="button" class="btn btn-success default mx-3">{{ $t('212') }}</button>
                            <button type="button" class="btn btn-success default mx-3">{{ $t('213') }}</button>
                            <button type="button" class="btn btn-success default mx-3">{{ $t('214') }}</button>
                            <button type="button" class="btn btn-success default mx-3">{{ $t('215') }}</button>
                            <button type="button" class="btn btn-danger default ml-3"  data-dismiss="modal">{{ $t('114') }}</button>
                            <!--<button v-show="editmode" type="submit" class="btn btn-success">{{ $t('105') }}</button>
                            <button v-show="!editmode" type="submit" class="btn btn-primary">{{ $t('104') }}</button>-->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function(){
            return{
                editmode: false,
                carpets :{},
                form: new Form({
                    id:'',
                    ticket_date:new Date().toISOString().slice(0, 10),
                    wash:-1,
                    ticket_status:-1,
                    client:-1,
                    phone_number:'',
                    carpet_size:-1,
                    wash_type:-1,
                    receipt_date:'',
                    expected_exit_date:'',
                    total_price:'',
                    num_of_materials:'',
                })
            }
        },

        methods: {
            getResults(page = 1) {
                axios.get('api/carpet_wash/?page=' + page).then((response) => {
                    this.carpets = response.data;
                });
            },

            newModal(){
                this.editmode = false;
                this.form.reset();
                $('#addNew').modal('show');
            },

            createUser(){
                this.$Progress.start();
                this.form.post('api/carpet_wash').then(()=>{
                    Fire.$emit('AfterCreate');
                    $('#addNew').modal('hide')
                    swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Data Created successfully',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    this.$Progress.finish();
                })
            },

            editRole(user){
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(user);
            },

            updateUser(){
                this.$Progress.start();
                this.form.put('api/carpet_wash/'+this.form.id).then(() => {
                    $('#addNew').modal('hide');
                    swal.fire(
                        'Updated!',
                        'Information has been updated.',
                        'success'
                    )
                    this.$Progress.finish();
                    Fire.$emit('AfterCreate');
                })
                .catch(() => {
                    this.$Progress.fail();
                });
            },

            deleteRole(id){
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
                        this.form.delete('api/carpet_wash/'+id).then(()=>{
                            swal.fire(
                                'Deleted!',
                                'Data has been deleted.',
                                'success'
                            )
                            Fire.$emit('AfterCreate');
                        }).catch(()=> {
                            swal.fire("Failed!", "This data assigned to an employee.", "warning");
                        });
                    }
                })
            },
        },

        created(){
            this.getResults();
            Fire.$on('AfterCreate',() => {
                this.getResults();
            });
        },

        computed: {
            ticket_date() {
                return this.$t('203')
            },

            phone_number() {
                return this.$t('207')
            },

            entrance_date() {
                return this.$t('210')
            },

            expected_exit_date() {
                return this.$t('211')
            },
        }
    }
</script>
