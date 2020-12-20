<template>
    <div class="container">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Organizational Structure
                            <div class="card-tools">
                                <button class="btn btn-success" @click="newDesignations">Add Designations</button>
                                <button class="btn btn-success" @click="newDeparment">Add Department</button>
                                <button class="btn btn-success" @click="newEmpLevel">Add Employee Level</button>
                            </div>
                        </div>
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="filters">Filters</label>
                                    <select name="filters" id="filters"  v-model="form.filters" class="form-control">
                                        <option value="-1">All</option>
                                        <option value="1">Designations</option>
                                        <option value="2">Department</option>
                                        <option value="3">Employee Level</option>
                                    </select>
                                </div>
                                <div class="col-md-3" style="margin-top:31px">
                                    <button class="btn btn-danger" @click="search">Search</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-body table-responsive p-0">
                                <table class="table table-bordered table-hover text-center">
                                    <thead class="thead-light">
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Status</th>
                                                <th>Modify</th>
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
                        <h5 class="modal-title w-100 font-weight-bold py-2" v-show="!editmode" id="addNewLabel">Create Designation</h5>
                        <h5 class="modal-title w-100 font-weight-bold py-2" v-show="editmode" id="addNewLabel">Update Designation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? updateUser() : createUser()">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="required" for="name">Name*</label>
                                        <input class="form-control"  v-model="form.name" type="text" name="name" id="name" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="status" class="required">status*</label>
                                        <select name="status" id="status"  v-model="form.status" class="form-control">
                                            <option value="-1">choose</option>
                                            <option value="1">Active</option>
                                            <option value="2">Stopped</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" cols="30" type="text"  v-model="form.description" name="description" id="description"></textarea>
                                    </div>
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
        <div class="modal fade" id="addDeparment" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title w-100 font-weight-bold py-2" v-show="!editmode" id="addNewLabel">Create Deparment</h5>
                        <h5 class="modal-title w-100 font-weight-bold py-2" v-show="editmode" id="addNewLabel">Update Deparment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? updateUser() : createUser()">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="required" for="name">Name*</label>
                                        <input class="form-control"  v-model="form.name" type="text" name="name" id="name" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="abbreviation">Abbreviation</label>
                                        <input class="form-control"  v-model="form.abbreviation" type="text" name="abbreviation" id="abbreviation">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="status" class="required">status*</label>
                                        <select name="status" id="status"  v-model="form.status" class="form-control">
                                            <option value="-1">choose</option>
                                            <option value="1">Active</option>
                                            <option value="2">Stopped</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" cols="30" type="text"  v-model="form.description" name="description" id="description"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="assign_manager">Select Employee</label>
                                        <select name="assign_manager" id="assign_manager"  v-model="form.assign_manager" class="form-control">
                                            <option value="-1">choose</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="month">Month</label>
                                        <select name="month" id="month"  v-model="form.month" class="form-control">
                                            <option value="-1">Select Month</option>
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
                                        <label for="day">Day</label>
                                        <select name="day" id="day"  v-model="form.day" class="form-control">
                                            <option value="-1">Select Day</option>
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
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
                            <button v-show="!editmode" type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="addEmpLevel" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title w-100 font-weight-bold py-2" v-show="!editmode" id="addNewLabel">Create Employee Level</h5>
                        <h5 class="modal-title w-100 font-weight-bold py-2" v-show="editmode" id="addNewLabel">Update Employee Level</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? updateUser() : createUser()">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="required" for="name">Name*</label>
                                        <input class="form-control"  v-model="form.name" type="text" name="name" id="name" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="status" class="required">status*</label>
                                        <select name="status" id="status"  v-model="form.status" class="form-control">
                                            <option value="-1">choose</option>
                                            <option value="1">Active</option>
                                            <option value="2">Stopped</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" cols="30" type="text"  v-model="form.description" name="description" id="description"></textarea>
                                    </div>
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

