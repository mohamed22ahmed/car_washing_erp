<style scoped>
button{
    color:white;
}
.form-rounded {
    border-radius: 1rem;
}
.default{
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
                            <h3 class="card-title">Mat Wash Ticket</h3>
                            <div class="card-tools">
                                <button class="btn btn-success" @click="newModal">
                                <i class="fas fa-plus fa-fw"></i>&nbsp; Add New Ticket</button>
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
                        <h5><span class="badge badge-pill badge-success">good client</span></h5>
                        <h5 class="modal-title" v-show="editmode" id="addNewLabel">Add New Ticket</h5>
                        <button type="button" class="close" style="color:black;" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form @submit.prevent="editmode ? updateUser() : createUser()">
                        <div class="modal-body">
                           <div class="row">
                                <div class="col-md-2">
                                   <h5><span class="badge badge-pill badge-secondary">120000002536</span></h5>
                                </div>

                                <div class="col-md-3">
                                    <input v-model="form.ticket_date" type="date" name="ticket_date" placeholder="ticket date" class="form-control form-rounded" :class="{ 'is-invalid': form.errors.has('ticket_date') }">
                                    <has-error :form="form" field="ticket_date"></has-error>
                                </div>

                                <div class="col-md-1"></div>

                                <div class="col-md-3">
                                   <select class="form-control form-rounded" name="wash_type" v-model="form.wash_type">
                                        <option selected value="-1">Wash select</option>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                     <select class="form-control form-rounded" name="ticket_status" v-model="form.ticket_status">
                                        <option selected value="-1">Ticket Status</option>
                                    </select>
                                </div>
                           </div>

                           <div class="row mt-3">
                                <div class="col-md-2">
                                   <select class="form-control form-rounded" name="client" v-model="form.client">
                                        <option selected value="-1">select client</option>
                                    </select>
                                </div>
                                <div class="col-md-1 mt-1" style="margin-left:-7px; width">
                                    <button class="btn btn-sm btn-success default">
                                    <i class="fas fa-plus"></i></button>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input v-model="form.phone" type="text" name="phone" placeholder="Phone Number" class="form-control form-rounded" :class="{ 'is-invalid': form.errors.has('phone') }">
                                        <has-error :form="form" field="phone"></has-error>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                   <div class="form-group">
                                        <input v-model="form.enter_date" type="date" name="enter_date" placeholder="Enterance Date" class="form-control form-rounded" :class="{ 'is-invalid': form.errors.has('enter_date') }">
                                        <has-error :form="form" field="enter_date"></has-error>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input v-model="form.exit_date" type="date" name="exit_date" placeholder="Exit expected Date" class="form-control form-rounded" :class="{ 'is-invalid': form.errors.has('exit_date') }">
                                        <has-error :form="form" field="exit_date"></has-error>
                                    </div>
                                </div>
                           </div>
                        </div>

                        <div class="modal-footer d-flex justify-content-center">
                            <button type="button" class="btn btn-success default mr-3" data-dismiss="modal">save</button>
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
    </div>
</template>

<script>
    export default {
        data: function(){
            return{
                editmode: false,
                roles :{},
                form: new Form({
                    id:'',
                    name : '',
                    name_ar: '',
                    ticket_date:'',
                    ticket_status:-1,
                    wash_type:-1,
                    color:-1,
                    brand:-1,
                    car_status:-1,
                    client:-1,
                    enter_date:'',
                    exit_date:'',
                    phone:'',
                })
            }
        },

        methods: {
            // getResults(page = 1) {
            //     axios.get('api/roles/?page=' + page).then((response) => {
            //         this.roles = response.data;
            //     });
            // },

            newModal(){
                this.editmode = false;
                this.form.reset();
                $('#addNew').modal('show');
            },

            // createUser(){
            //     this.$Progress.start();
            //     this.form.post('api/roles').then(()=>{
            //         Fire.$emit('AfterCreate');
            //         $('#addNew').modal('hide')
            //         swal.fire({
            //             position: 'top-end',
            //             icon: 'success',
            //             title: 'Role Created successfully',
            //             showConfirmButton: false,
            //             timer: 1500
            //         })
            //         this.$Progress.finish();
            //     })
            // },

            editRole(user){
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

        // created(){
        //     this.getResults();
        //     Fire.$on('AfterCreate',() => {
        //         this.getResults();
        //     });
        // }
    }
</script>
