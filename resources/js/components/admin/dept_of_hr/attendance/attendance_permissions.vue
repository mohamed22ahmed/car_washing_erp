<template>
    <div class="container">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                        <h3 class="card-title">{{ $t('57') }}</h3>
                            <div class="card-tools">
                                <button class="btn btn-success" @click="newModal">
                                    <i class="fas fa-plus fa-fw"></i>&nbsp; {{ $t('58') }}
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
                                            <th>{{ $t('16') }}</th>
                                            <th>{{ $t('110') }}</th>
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
                        <h5 class="modal-title w-100 font-weight-bold py-2" v-show="!editmode" id="addNewLabel">{{ $t('58') }}</h5>
                        <h5 class="modal-title w-100 font-weight-bold py-2" v-show="editmode" id="addNewLabel">{{ $t('105') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? updateUser() : createUser()">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="employee_id">{{ $t('59') }} *</label>
                                                <select name="employee_id" v-model="form.employee_id" id="employee_id" class="form-control">
                                                    <option value="-1">choose</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label for="date">{{ $t('101') }} *</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <select name="select" v-model="form.select" id="select" class="form-control">
                                                        <option value="1">{{ $t('60') }}</option>
                                                        <option value="2">{{ $t('61') }}</option>
                                                    </select>
                                                </div>
                                                <input v-if="form.select==2" type="text" placeholder="From date" class="form-control" v-model="form.from_date" name="from_date" onfocus="(this.type='date')" onblur="(this.type='text')" id="from_date">
                                                <input v-if="form.select==1" type="text" placeholder="From date" class="form-control" v-model="form.from_date" name="from_date" onfocus="(this.type='date')" onblur="(this.type='text')" id="from_date">
                                                <input v-if="form.select==1" type="text" placeholder="To date" class="form-control" v-model="form.to_date" onfocus="(this.type='date')" onblur="(this.type='text')" name="to_date" id="to_date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="type">{{ $t('103') }} *</label>
                                                <select name="type" v-model="form.type" id="type" class="form-control">
                                                    <option value="1">{{ $t('62') }}</option>
                                                    <option value="2">{{ $t('63') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="notes">{{ $t('15') }}</label>
                                                <textarea class="form-control" id="notes" name="notes" v-model="form.notes" rows="3"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="leave_type" class="required">{{ $t('62')}} {{ $t('103') }} *</label>
                                                <select name="leave_type" v-model="form.leave_type" id="leave_type" class="form-control">
                                                    <option value="-1">Please Select</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="app_date">{{ $t('64') }}</label>
                                                <input type="date" class="form-control" v-model="form.app_date" name="app_date" id="app_date">
                                            </div>
                                        </div>
                                    </div>
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
            editmode: false,
            form: new Form({
                employee:-1,
                type:1,
                from_date:'',
                to_date:'',
                select:1,
                notes:'',
                leave_type:-1,
                app_date:'',
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
