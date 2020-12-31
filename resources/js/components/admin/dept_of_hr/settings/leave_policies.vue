<template>
    <div class="container">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                        <h3 class="card-title">{{$t('166')}}</h3>
                            <div class="card-tools">
                                <button class="btn btn-success" @click="newModal">
                                    <i class="fas fa-plus fa-fw"></i>&nbsp; {{ $t('165') }}
                                </button>
                                <router-link :to="{ path: '/leave_setups'}" class="btn btn-success">
                                    <i class="fas fa-plus fa-fw"></i>&nbsp; {{ $t('164') }}
                                </router-link>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="card-body table-responsive p-0">
                            <table class="table table-bordered table-hover text-center">
                                <thead class="thead-light">
                                        <tr>
                                            <th>{{ $t('109') }}</th>
                                            <th>{{ $t('50') }}</th>
                                            <th>{{ $t('56') }}</th>
                                            <th>{{ $t('18') }}</th>
                                            <th>{{ $t('110') }}</th>
                                        </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="leave in leaves" :key="leave.id">
                                        <td>{{ leave.id }}</td>
                                        <td>{{ leave.name }}</td>
                                        <td>{{ leave.name_ar }}</td>
                                        <td  v-if="leave.status==1"><span class="badge badge-sm badge-rounded badge-success">{{ leave.status==1?'active':'Stopped' }}</span></td>
                                        <td  v-if="leave.status==2"><span class="badge badge-sm badge-rounded badge-danger">{{ leave.status==1?'active':'Stopped' }}</span></td>
                                        <td>
                                            <a href="#" @click="editModal(leave)">
                                                <i class="fa fa-edit red"></i>
                                            </a>&nbsp;/
                                            <a href="#" @click="deleteLeave(leave.id)">
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

        <!--Modal-->
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title w-100 font-weight-bold py-2" v-show="!editmode" id="addNewLabel">{{ $t('162') }}</h5>
                        <h5 class="modal-title w-100 font-weight-bold py-2" v-show="editmode" id="addNewLabel">{{ $t('161') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? updateLeave() : createLeave()">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="name">{{$t('50')}}<span style="color:red;">*</span></label>
                                                 <input type="text" placeholder="Name" class="form-control" v-model="form.name" name="name" id="name">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="name_ar">{{$t('56')}}<span style="color:red;">*</span></label>
                                                 <input type="text" placeholder="Name_ar" class="form-control" v-model="form.name_ar" name="name_ar" id="name_ar" dir="rtl">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="status" class="required">{{$t('18')}}<span style="color:red;">*</span></label>
                                                <select name="status" v-model="form.status" id="status" class="form-control">
                                                    <option value="1">{{$t('19')}}</option>
                                                    <option value="2">{{$t('20')}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="description">{{$t('113')}}</label>
                                                <textarea class="form-control" id="description" name="description" v-model="form.description" rows="3"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="panel-head bg-light" style="height:40px">
                                        <span style="font-weight:bold;" class="pr-3">{{$t('163')}}</span>
                                    </div>

                                    <div class="row">
                                        <div class="col-6">
                                            <!-- <div id="table" class="table-editable">
                                            <span class="table-add float-right mb-3 mr-2">Add new line<a @click="tableInsert" href="#!" class="text-success"><i
                                            class="fas fa-plus mx-2" aria-hidden="true"></i></a></span>
                                            <table class="table table-bordered table-responsive-md text-center">
                                            <thead class="thead-light">
                                                <tr >
                                                    <th class="text-center">Leave Type</th>
                                                    <th class="text-center">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="hide">
                                                    <td class="pt-3-half">
                                                    <div class="form-group">
                                                        <select name="leave_type" v-model="form.leave_type" id="leave_type" class="form-control">
                                                            <option value="-1">Select Leave Type</option>
                                                        </select>
                                                    </div>
                                                    </td>
                                                    <td>
                                                        <span class="table-remove"><button type="button"
                                                            class="btn btn-danger btn-rounded btn-sm my-0">delete</button>
                                                        </span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                            </div> -->
                                            <label for="leave_type">{{$t('168')}}</label>
                                            <select class="form-control" label="leave_type" id="leave_type" name="leave_type" v-model="form.leave_type">
                                                <option v-for="type in types" :key="type.id" :value="type.id">{{ type.name }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" style="color:white;">{{ $t('114') }}</button>
                            <button v-show="editmode" type="submit" class="btn btn-success" style="color:white;">{{ $t('105') }}</button>
                            <button v-show="!editmode" type="submit" class="btn btn-primary" style="color:white;">{{ $t('104') }}</button>
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
            leaves:{},
            types:[],
            editmode: false,
            form: new Form({
               id:'',
                name:'',
                name_ar:'',
                status:1,
                description:'',
                leave_type:-1,
            })
        }
    },
    methods:{

        getResults(page = 1) {
            axios.get('api/leave_policies/?page=' + page).then((response) => {
                this.leaves = response.data;
            });
            axios.get('api/get_leaves').then((response) => {
                this.types = response.data;
            });
        },

        newModal(){
            this.editmode = false;
            this.form.reset();
            $('#addNew').modal('show');
        },

        createLeave(){
            this.$Progress.start();
            this.form.post('api/leave_policies').then(()=>{
                Fire.$emit('AfterCreate');
                $('#addNew').modal('hide')
                swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Leave Policy Created successfully',
                    showConfirmButton: false,
                    timer: 1500
                })
                this.$Progress.finish();
            })
        },

        editModal(user){
            this.editmode = true;
            this.form.reset();
            $('#addNew').modal('show');
            this.form.fill(user);
        },

        updateLeave(){
            this.$Progress.start();
            this.form.put('api/leave_policies/'+ this.form.id)
                .then(() => {
                    // success
                    $('#addNew').modal('hide');
                    swal.fire(
                        'Updated!',
                        'Leave Policy has been updated.',
                        'success'
                    )
                    this.$Progress.finish();
                    Fire.$emit('AfterCreate');
                })
                .catch(() => {
                    this.$Progress.fail();
                });
        },

        deleteLeave(id){
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
                    this.form.delete('api/leave_policies/'+id).then(()=>{
                        swal.fire(
                            'Deleted!',
                            'Leave Policy has been deleted.',
                            'success'
                        )
                        Fire.$emit('AfterCreate');
                    }).catch(()=> {
                        swal.fire("Failed!", "This Leave Policy is Error", "warning");
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
