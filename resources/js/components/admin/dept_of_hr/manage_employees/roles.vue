<template>
    <div class="container">
        <div class="container">
            <div class="row mt-5"  >
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ $t('23') }}</h3>
                            <div class="card-tools">
                                <button class="btn btn-success" @click="newModal">
                                <i class="fas fa-plus fa-fw"></i>&nbsp; {{ $t('55') }}</button>
                            </div>
                        </div>

                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <th>{{ $t('108') }}</th>
                                        <th>{{ $t('50') }}</th>
                                        <th>{{ $t('56') }}</th>
                                        <th>{{ $t('110') }}</th>
                                    </tr>
                                    <tr v-for="role in roles.data" :key="role.id">
                                        <td>{{ role.id }}</td>
                                        <td>{{ role.name }}</td>
                                        <td>{{ role.name_ar }}</td>
                                        <td>
                                            <a href="#" @click="editRole(role)">
                                                <i class="fa fa-edit red"></i>
                                            </a>&nbsp;
                                            <a href="#" @click="deleteRole(role.id)">
                                                <i class="fa fa-trash red"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                            <div class="card-footer">
                                <pagination :data="roles" @pagination-change-page="getResults"></pagination>
                            </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-show="!editmode" id="addNewLabel">{{ $t('55') }}</h5>
                        <h5 class="modal-title" v-show="editmode" id="addNewLabel">{{ $t('105') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form @submit.prevent="editmode ? updateUser() : createUser()">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name" class="col-sm-4 control-label">{{ $t('50') }}</label>
                                <input type="text" v-model="form.name" name="name" placeholder="English Description" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                                <has-error :form="form" field="name"></has-error>
                            </div>

                            <div class="form-group">
                                <label for="name" class="col-sm-4 control-label">{{ $t('56') }}</label>
                                <input v-model="form.name_ar" type="text" name="name_ar" placeholder="Arabic Description" class="form-control" :class="{ 'is-invalid': form.errors.has('name_ar') }" dir="rtl">
                                <has-error :form="form" field="name_ar"></has-error>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">{{ $t('114') }}</button>
                            <button v-show="editmode" type="submit" class="btn btn-success">{{ $t('105') }}</button>
                            <button v-show="!editmode" type="submit" class="btn btn-primary">{{ $t('104') }}</button>
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
                })
            }
        },

        methods: {
            getResults(page = 1) {
                axios.get('api/roles/?page=' + page).then((response) => {
                    this.roles = response.data;
                });
            },

            newModal(){
                this.editmode = false;
                this.form.reset();
                $('#addNew').modal('show');
            },

            createUser(){
                this.$Progress.start();
                this.form.post('api/roles').then(()=>{
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

            editRole(user){
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(user);
            },

            updateUser(){
                this.$Progress.start();
                this.form.put('api/roles/'+this.form.id).then(() => {
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
                        this.form.delete('api/roles/'+id).then(()=>{
                            swal.fire(
                                'Deleted!',
                                'Role has been deleted.',
                                'success'
                            )
                            Fire.$emit('AfterCreate');
                        }).catch(()=> {
                            swal.fire("Failed!", "This Role assigned to an employee.", "warning");
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
        }
    }
</script>
