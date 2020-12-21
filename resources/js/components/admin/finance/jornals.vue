<template>
    <div class="container">

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ $t('100') }}</h3>
                                <div class="card-tools">
                                    <button class="btn btn-success" @click="newModal">
                                    <i class="fas fa-plus fa-fw"></i>&nbsp; {{ $t('102') }}</button>
                                </div>
                            </div>
                        <div class="card-body">
                            <div class="card-body table-responsive p-0">
                                <table class="table table-bordered table-hover text-center">
                                    <thead class="thead-light">
                                            <tr>
                                                <th>{{ $t('109') }}</th>
                                                <th>{{ $t('101') }}</th>
                                                <th>{{ $t('103') }}</th>
                                                <th>{{ $t('110') }}</th>
                                            </tr>
                                    </thead>
                                    <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>02/02/2020</td>
                                                <td>Active</td>
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
                        <h5 class="modal-title w-100 font-weight-bold py-2" v-show="!editmode" id="addNewLabel">{{ $t('104') }} {{ $t('108') }}</h5>
                        <h5 class="modal-title w-100 font-weight-bold py-2" v-show="editmode" id="addNewLabel">{{ $t('105') }} {{ $t('108') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? updateUser() : createUser()">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group my-3">
                                        <div class="input-group-prepend">
                                        <label for="date" class="input-group-text">{{ $t('101') }}</label>
                                        </div>
                                        <input v-model="form.date" type="date" name="date" class="form-control" :class="{ 'is-invalid': form.errors.has('date') }">
                                        <has-error :form="form" field="date"></has-error>
                                    </div>

                                    <div class="input-group my-3">
                                        <div class="input-group-prepend">
                                            <label for="currency" class="input-group-text">{{ $t('111') }}</label>
                                        </div>
                                        <select v-model="form.currency" name="currency" id="currency" class="custom-select">
                                            <option value="-1">{{ $t('115') }}</option>
                                            <option value="1">جنيه مصرى EGP</option>
                                            <option value="2">ريال سعودى SAR</option>
                                            <option value="3">درهم إماراتى AED</option>
                                        </select>
                                    </div>

                                    <div class="input-group my-3">
                                        <div class="input-group-prepend">
                                        <label for="number" class="input-group-text">{{ $t('112') }}</label>
                                        </div>
                                        <input v-model="form.number" type="text" name="number" placeholder="Number" class="form-control" :class="{ 'is-invalid': form.errors.has('number') }">
                                        <has-error :form="form" field="number"></has-error>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="input-group mt-2">
                                        <div class="input-group-prepend">
                                        <label for="description" class="input-group-text">{{ $t('113') }}</label>
                                        </div>
                                        <textarea v-model="form.description" class="form-control" rows="6" :class="{ 'is-invalid': form.errors.has('description') }"></textarea>
                                        <has-error :form="form" field="description"></has-error>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <table_editable></table_editable>
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
    data: function() {
        return {
            editmode: false,
            form: new Form({
                date: '',
                currency: '',
                number: '',
                description: '',
            }),
        }
    },
    methods: {
        // loadUsers: function() {
        //     axios.get("api/index").then((res) => {
        //         console.log(res.data)
        //     });
        // },

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

    // created() {
    //     this.loadUsers();
    // },
}
</script>
