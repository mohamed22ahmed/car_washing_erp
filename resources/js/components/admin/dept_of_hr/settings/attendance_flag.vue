<template>
    <div class="container">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                        <h3 class="card-title">{{$t('151')}}</h3>
                            <div class="card-tools">
                                <button class="btn btn-success" @click="newModal">
                                    <i class="fas fa-plus fa-fw"></i>&nbsp; {{$t('152')}}
                                </button>
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
                                        <tr v-for="flag in flags.data" :key="flag.id">
                                            <td>{{ flag.id }}</td>
                                            <td :style="{color:flag.colour}">{{ flag.name }}</td>
                                            <td :style="{color:flag.colour}">{{ flag.name_ar }}</td>
                                            <td  v-if="flag.status==1"><span class="badge badge-sm badge-rounded badge-success">{{ flag.status==1?'active':'Stopped' }}</span></td>
                                            <td  v-if="flag.status==2"><span class="badge badge-sm badge-rounded badge-danger">{{ flag.status==1?'active':'Stopped' }}</span></td>
                                            <td>
                                                <a href="#" @click="editModal(flag)">
                                                    <i class="fa fa-edit red"></i>
                                                </a>&nbsp;/
                                                <a href="#" @click="deleteFlag(flag.id)">
                                                    <i class="fa fa-trash red"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card-footer">
                        <pagination :data="flags" @pagination-change-page="getResults"></pagination>
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
                        <h5 class="modal-title w-100 font-weight-bold py-2" v-show="!editmode" id="addNewLabel">{{$t('154')}}</h5>
                        <h5 class="modal-title w-100 font-weight-bold py-2" v-show="editmode" id="addNewLabel">{{$t('153')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? updateFlag() : createFlag()">
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
                                                <label for="colour" class="control-label">{{$t('149')}}</label>
                                                <input v-model="form.colour" type="color" name="colour" placeholder="Flag colour" class="form-control" :class="{ 'is-invalid': form.errors.has('colour') }">
                                                <has-error :form="form" field="colour"></has-error>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="description">{{$t('113')}}</label>
                                                <textarea class="form-control" id="description" name="description" v-model="form.description" rows="3"></textarea>
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
                                                <label for="shift" class="required">{{$t('150')}}<span style="color:red;">*</span></label>
                                                <select name="shift" v-model="form.shift" id="shift" class="form-control">
                                                    <option v-for="sh in shifts" :key="sh.id" :value="sh.id">{{ sh.name }}</option>
                                                </select>
                                            </div>
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
            flags:{},
            shifts:{},
            editmode: false,
            form: new Form({
                id:'',
                name:'',
                name_ar:'',
                colour:'',
                description:'',
                status:1,
                shift:'',
            })
        }
    },
    methods:{
        getShifts(){
            axios.get('api/shift_management').then((response) => {
                this.shifts = response.data;
            });
        },
        getResults(page = 1) {
            axios.get('api/attendance_flags/?page=' + page).then((response) => {
                this.flags = response.data;
            });
        },

        newModal() {
            this.editmode = false;
            this.form.reset();
            $('#addNew').modal('show');
        },

        createFlag(){
            this.$Progress.start();
            this.form.post('api/attendance_flags').then(()=>{
                Fire.$emit('AfterCreate');
                $('#addNew').modal('hide')
                swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Attendance Flag Created successfully',
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

        updateFlag() {
            this.$Progress.start();
            this.form.put('api/attendance_flags/'+ this.form.id)
                .then(() => {
                    // success
                    $('#addNew').modal('hide');
                    swal.fire(
                        'Updated!',
                        'Attendance Flag has been updated.',
                        'success'
                    )
                    this.$Progress.finish();
                    Fire.$emit('AfterCreate');
                })
                .catch(() => {
                    this.$Progress.fail();
                });
        },

        deleteFlag(id){
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
                    this.form.delete('api/attendance_flags/'+id).then(()=>{
                        swal.fire(
                            'Deleted!',
                            'Attendance Flag has been deleted.',
                            'success'
                        )
                        Fire.$emit('AfterCreate');
                    }).catch(()=> {
                        swal.fire("Failed!", "This Attendance Flag is Error", "warning");
                    });
                }
            })
        },
    },

    created(){
        this.getShifts()
        this.getResults();
        Fire.$on('AfterCreate',() => {
            this.getResults();
        });
    }
}
</script>
