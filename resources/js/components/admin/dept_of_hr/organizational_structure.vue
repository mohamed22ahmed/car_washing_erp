<template>
    <div class="container">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                        <h3 class="card-title">{{ $t('132') }}</h3>
                            <div class="card-tools">
                                <button class="btn btn-success" @click="newDesignations">{{ $t('133') }} {{ $t('35') }}</button>
                                <button class="btn btn-success" @click="newDeparment">{{ $t('133') }} {{ $t('36') }}</button>
                                <button class="btn btn-success" @click="newEmpLevel">{{ $t('133') }} {{ $t('37') }}</button>
                            </div>
                        </div>
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="filters">{{ $t('134') }}</label>
                                    <select name="filters" id="filters"  v-model="form.filters" class="form-control">
                                        <option value="-1">{{ $t('135') }}</option>
                                        <option value="1">{{ $t('35') }}</option>
                                        <option value="2">{{ $t('36') }}</option>
                                        <option value="3">{{ $t('37') }}</option>
                                    </select>
                                </div>
                                <div class="col-md-3" style="margin-top:31px">
                                    <button class="btn btn-danger" @click="search">{{ $t('54') }}</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-body table-responsive p-0">
                                <table class="table table-bordered table-hover text-center">
                                    <thead class="thead-light">
                                            <tr>
                                                <th>{{ $t('109') }}</th>
                                                <th>{{ $t('50') }}</th>
                                                <th>{{ $t('18') }}</th>
                                                <th>{{ $t('110') }}</th>
                                            </tr>
                                    </thead>
                                    <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Nada</td>
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

        <div class="modal fade" id="addDesignation" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title w-100 font-weight-bold py-2" v-show="!editmode" id="addNewLabel">{{ $t('104') }} {{ $t('35') }}</h5>
                        <h5 class="modal-title w-100 font-weight-bold py-2" v-show="editmode" id="addNewLabel">{{ $t('105') }} {{ $t('35') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? updateUser() : createUser()">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="name">{{ $t('50') }}<span style="color:red;">*</span></label>
                                        <input class="form-control"  v-model="form.name" type="text" name="name" id="name" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="status">{{ $t('18') }}<span style="color:red;">*</span></label>
                                        <select name="status" id="status"  v-model="form.status" class="form-control">
                                            <option value="-1">{{ $t('115') }}</option>
                                            <option value="1">{{ $t('19') }}</option>
                                            <option value="2">{{ $t('20') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="description">{{ $t('113') }}</label>
                                        <textarea class="form-control" cols="30" type="text"  v-model="form.description" name="description" id="description"></textarea>
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
        <div class="modal fade" id="addDeparment" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title w-100 font-weight-bold py-2" v-show="!editmode" id="addNewLabel">{{ $t('104') }} {{ $t('36') }}</h5>
                        <h5 class="modal-title w-100 font-weight-bold py-2" v-show="editmode" id="addNewLabel">{{ $t('105') }} {{ $t('36') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? updateUser() : createUser()">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="required" for="name">{{ $t('50') }}<span style="color:red;">*</span></label>
                                        <input class="form-control"  v-model="form.name" type="text" name="name" id="name" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="abbreviation">{{ $t('136') }}</label>
                                        <input class="form-control"  v-model="form.abbreviation" type="text" name="abbreviation" id="abbreviation">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="status">{{ $t('18') }}<span style="color:red;">*</span></label>
                                        <select name="status" id="status"  v-model="form.status" class="form-control">
                                            <option value="-1">{{ $t('115') }}</option>
                                            <option value="1">{{ $t('19') }}</option>
                                            <option value="2">{{ $t('20') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="description">{{ $t('113') }}</label>
                                        <textarea class="form-control" cols="30" type="text"  v-model="form.description" name="description" id="description"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="assign_manager">{{ $t('137') }}</label>
                                        <select name="assign_manager" id="assign_manager"  v-model="form.assign_manager" class="form-control">
                                            <option value="-1">{{ $t('115') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="month">{{ $t('138') }}</label>
                                        <select name="month" id="month"  v-model="form.month" class="form-control">
                                            <option value="-1">{{ $t('115') }} {{ $t('138') }}</option>
                                            <option value="1">January</option>
                                            <option value="2">February</option>
                                            <option value="3">March</option>
                                            <option value="4">April</option>
                                            <option value="5">May</option>
                                            <option value="6">June</option>
                                            <option value="7">July</option>
                                            <option value="8">August</option>
                                            <option value="9">September</option>
                                            <option value="10">October</option>
                                            <option value="11">November</option>
                                            <option value="12">December</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="day">{{ $t('139') }}</label>
                                        <select name="day" id="day"  v-model="form.day" class="form-control">
                                            <option value="-1">{{ $t('115') }} {{ $t('139') }}</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
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
        <div class="modal fade" id="addEmpLevel" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title w-100 font-weight-bold py-2" v-show="!editmode" id="addNewLabel">{{ $t('104') }} {{ $t('37') }}</h5>
                        <h5 class="modal-title w-100 font-weight-bold py-2" v-show="editmode" id="addNewLabel">{{ $t('105') }} {{ $t('37') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? updateUser() : createUser()">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ $t('50') }}<span style="color:red;">*</span></label>
                                        <input class="form-control"  v-model="form.name" type="text" name="name" id="name" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="status">{{ $t('18') }}<span style="color:red;">*</span></label>
                                        <select name="status" id="status"  v-model="form.status" class="form-control">
                                            <option value="-1">{{ $t('115') }}</option>
                                            <option value="1">{{ $t('19') }}</option>
                                            <option value="2">{{ $t('20') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="description">{{ $t('113') }}</label>
                                        <textarea class="form-control" cols="30" type="text"  v-model="form.description" name="description" id="description"></textarea>
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
    data: function() {
        return {
            editmode: false,
            form: new Form({
                name: '',
                status: -1,
                description: '',
                abbreviation: '',
                assign_manager:-1,
                filters:-1,
                day:-1,
                month:-1,
            }),
        }
    },
    methods: {
        // loadUsers: function() {
        //     axios.get("api/index").then((res) => {
        //         console.log(res.data)
        //     });
        // },

        newDesignations() {
            this.editmode = false;
            this.form.reset();
            $('#addDesignation').modal('show');
        },
        newDeparment() {
            this.editmode = false;
            this.form.reset();
            $('#addDeparment').modal('show');
        },
        newEmpLevel() {
            this.editmode = false;
            this.form.reset();
            $('#addEmpLevel').modal('show');
        },

        editDesignations(user){
            this.editmode = true;
            this.form.reset();
            $('#addDesignations').modal('show');
            this.form.fill(user);
        },
        editDeparment(user) {
            this.editmode = false;
            this.form.reset();
            $('#addDeparment').modal('show');
        },
        editEmpLevel(user) {
            this.editmode = false;
            this.form.reset();
            $('#addEmpLevel').modal('show');
        },
    },

    // created() {
    //     this.loadUsers();
    // },
}
</script>

