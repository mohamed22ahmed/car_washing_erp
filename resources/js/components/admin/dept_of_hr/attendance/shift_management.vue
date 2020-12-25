<template>
    <div class="container">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                        <h3 class="card-title">{{ $t('65') }}</h3>
                            <div class="card-tools">
                                <button class="btn btn-success" @click="newModal">
                                    <i class="fas fa-plus fa-fw"></i>&nbsp; {{ $t('66') }}
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
                                            <th>{{ $t('110') }}</th>
                                        </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="shift in shifts" :key="shift.id">
                                        <td>{{ shift.id }}</td>
                                        <td>{{ shift.name }}</td>
                                        <td>{{ shift.name_ar }}</td>
                                        <td>
                                            <a href="#" @click="editShift(shift)">
                                                <i class="fa fa-edit blue"></i>
                                            </a>
                                            /
                                            <a href="#" @click="deleteShift(shift.id)">
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
                        <h5 class="modal-title w-100 font-weight-bold py-2" v-show="!editmode" id="addNewLabel">{{ $t('66') }}</h5>
                        <h5 class="modal-title w-100 font-weight-bold py-2" v-show="editmode" id="addNewLabel">{{ $t('105') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? updateUser() : createUser()">
                        <div class="modal-body">
                            <div class="row">
                               <div class="form-group col-md-6">
                                    <label for="name" class="control-label">{{ $t('50') }} *</label>
                                    <input v-model="form.name" type="text" name="name" placeholder="English Description" class="form-control">
                                    <has-error :form="form" field="name"></has-error>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="name" class="control-label">{{ $t('56') }} *</label>
                                    <input v-model="form.name_ar" type="text" name="name_ar" placeholder="Arabic Description" class="form-control" dir="rtl">
                                    <has-error :form="form" field="name_ar"></has-error>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="on_duty_time">{{ $t('67') }} *</label>
                                    <div>
                                        <input type="time" name="on_duty_time" v-model="form.on_duty_time" id="on_duty_time" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="off_duty_time">{{ $t('68') }} *</label>
                                    <div>
                                        <input type="time" name="off_duty_time" v-model="form.off_duty_time" id="off_duty_time" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="begin1">{{ $t('69') }} *</label>
                                    <div>
                                        <input type="time" name="begin1" v-model="form.begin1" id="begin1" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="end1">{{ $t('70') }} *</label>
                                    <div>
                                        <input type="time" name="end1" v-model="form.end1" id="end1" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row" v-if="form.shift_two==1">
                                <div class="form-group col-md-6">
                                    <label for="begin2">{{ $t('69') }} * ({{ $t('71') }} 2)</label>
                                    <div>
                                        <input type="time" name="begin2" v-model="form.begin2" id="begin2" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="end2">{{ $t('70') }} * ({{ $t('71') }} 2)</label>
                                    <div>
                                        <input type="time" name="end2" v-model="form.end2" id="end2" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="control-label">{{ $t('72') }}</label>
                                    <v-select multiple  :options="week_days_all"  label="week_days" id="week_days" name="week_days" v-model="form.week_days"></v-select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="control-label"></label>
                                    <div class="custom-control custom-switch custom-switch-on-success">
                                        <input type="checkbox"  class="custom-control-input" id="assign_another_shift" checked name="assign_another_shift" v-model="form.assign_another_shift">
                                        <label class="custom-control-label" for="assign_another_shift">{{ $t('73') }}</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <div class="form-check">
                                        <input v-model="form.start_late" type="checkbox" name="start_late" id="start_late" class="form-check-input">
                                        <label for="start_late" class="form-check-label">{{ $t('74') }} *</label>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <input :disabled="form.start_late==0" v-model="form.late_minutes" type="number" name="late_minutes" class="form-control">
                                </div>
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
            week_days_all:['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'],
            shifts:{},
            editmode: false,
            form: new Form({
                id:'',
                name:'',
                name_ar:'',
                on_duty_time:'',
                off_duty_time:'',
                begin1:'',
                end1:'',
                begin2:'',
                end2:'',
                assign_another_shift:0,
                week_days:[],
                start_late:0,
                late_minutes:'',
            })
        }
    },
    methods:{
        getResults(page = 1) {
            axios.get('api/shift_management/?page=' + page).then((response) => {
                this.shifts = response.data;
            });
        },

        newModal() {
            this.editmode = false;
            this.form.reset();
            $('#addNew').modal('show');
        },

        createUser(){
            this.$Progress.start();
            this.form.post('api/shift_management').then(()=>{
                Fire.$emit('AfterCreate');
                $('#addNew').modal('hide')
                swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Shift Created successfully',
                    showConfirmButton: false,
                    timer: 1500
                })
                this.$Progress.finish();
            })
        },

        editShift(shift){
            this.editmode = true;
            this.form.reset();
            $('#addNew').modal('show');
            this.form.fill(shift);
        },

        updateUser(){
            this.$Progress.start();
            this.form.put('api/shift_management/'+this.form.id).then(() => {
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

        deleteShift(id){
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
                    this.form.delete('api/shift_management/'+id).then(()=>{
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

    created() {
        this.getResults()
        Fire.$on('AfterCreate',() => {
            this.getResults();
        });
    },
}
</script>
