<template>
    <div class="container">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Shift Management
                            <div class="card-tools">
                                <button class="btn btn-success" @click="newModal">
                                    <i class="fas fa-plus fa-fw"></i>&nbsp; Add Shift
                                </button>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="card-body table-responsive p-0">
                            <table class="table table-bordered table-hover text-center">
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
        </div>

        <!--Modal-->
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title w-100 font-weight-bold py-2" v-show="!editmode" id="addNewLabel">Create Shift</h5>
                        <h5 class="modal-title w-100 font-weight-bold py-2" v-show="editmode" id="addNewLabel">Update Shift</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? updateUser() : createUser()">
                        <div class="modal-body">
                            <div class="row">
                               <div class="form-group col-md-6">
                                    <label for="name" class="control-label">English Name *</label>
                                    <input v-model="form.name" type="text" name="name" placeholder="English Description" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                                    <has-error :form="form" field="name"></has-error>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="name" class="control-label">Arabic Name *</label>
                                    <input v-model="form.name_ar" type="text" name="name_ar" placeholder="Arabic Description" class="form-control" :class="{ 'is-invalid': form.errors.has('name_ar') }" dir="rtl">
                                    <has-error :form="form" field="name_ar"></has-error>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="on_duty_time">On Duty Time *</label>
                                    <div>
                                        <input type="time" name="on_duty_time" v-model="form.on_duty_time" id="on_duty_time" class="form-control" :class="{ 'is-invalid': form.errors.has('on_duty_time') }">
                                        <has-error :form="form" field="on_duty_time"></has-error>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="off_duty_time">Off Duty Time *</label>
                                    <div>
                                        <input type="time" name="off_duty_time" v-model="form.off_duty_time" id="off_duty_time" class="form-control" :class="{ 'is-invalid': form.errors.has('off_duty_time') }">
                                        <has-error :form="form" field="off_duty_time"></has-error>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="begin_in">Beginning In *</label>
                                    <div>
                                        <input type="time" name="begin_in" v-model="form.begin_in" id="begin_in" class="form-control" :class="{ 'is-invalid': form.errors.has('begin_in') }">
                                        <has-error :form="form" field="begin_in"></has-error>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="begin_out">Ending In *</label>
                                    <div>
                                        <input type="time" name="begin_out" v-model="form.begin_out" id="begin_out" class="form-control" :class="{ 'is-invalid': form.errors.has('begin_out') }">
                                        <has-error :form="form" field="begin_out"></has-error>
                                    </div>
                                </div>
                            </div>

                            <div class="row" v-if="form.shift_two==1">
                                <div class="form-group col-md-6">
                                    <label for="shift_begin_in">Beginning In * (Shift 2)</label>
                                    <div>
                                        <input type="time" name="shift_begin_in" v-model="form.shift_begin_in" id="shift_begin_in" class="form-control" :class="{ 'is-invalid': form.errors.has('shift_begin_in') }">
                                        <has-error :form="form" field="shift_begin_in"></has-error>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="shift_begin_out">Ending In * (Shift 2)</label>
                                    <div>
                                        <input type="time" name="shift_begin_out" v-model="form.shift_begin_out" id="shift_begin_out" class="form-control" :class="{ 'is-invalid': form.errors.has('shift_begin_out') }">
                                        <has-error :form="form" field="shift_begin_out"></has-error>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="control-label">Week Days</label>
                                    <v-select multiple  :options="week_days"
                                            label="name" id="allowances_include"
                                            name="allowances_include">
                                    </v-select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label"></label>
                                    <div class="custom-control custom-switch custom-switch-on-success">
                                        <input type="checkbox"  class="custom-control-input" id="shift_two" checked name="shift_two" v-model="form.shift_two">
                                        <label class="custom-control-label" for="shift_two">Assign Another Shift</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <div class="form-check">
                                        <input v-model="form.delay_after_mins_flag" type="checkbox" name="delay_after_mins_flag" id="delay_after_mins_flag" class="form-check-input">
                                        <label for="delay_after_mins_flag" class="form-check-label">Start late time from on duty *</label>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <input :disabled="form.delay_after_mins_flag==0" v-model="form.delay_after_mins_period" type="time" name="delay_after_mins_period" class="form-control" :class="{ 'is-invalid': form.errors.has('delay_after_mins_period') }">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
                            <button v-show="!editmode" type="submit" class="btn btn-primary">Create</button>
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
            week_days:['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'],
            editmode: false,
            form: new Form({
                name: '',
                name_ar: '',
                on_duty_time: '',
                off_duty_time: '',
                begin_in: '',
                begin_out: '',
                shift_begin_in: '',
                shift_begin_out: '',
                week_day: -1,
                delay_after_mins_flag: 0,
                delay_after_mins_period: 0,
                shift_two:0,
            })
        }
    },
    methods:{

        newModal() {
            this.editmode = false;
            this.form.reset();
            $('#addNew').modal('show');
        },

        editModal(user){
            this.editmode = true;
            this.form.reset();
            $('#addNew').modal('show');
            this.form.fill(user);
        },
    },
}
</script>
