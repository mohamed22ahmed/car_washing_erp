<style>
    label{
        font-weight: 500;
    }
    section{
        padding: 60px 0;
    }

    #accordion-style-1 h1,
    #accordion-style-1 a{
        color:#007b5e;
    }
    #accordion-style-1 .btn-link {
        font-weight: 400;
        color:royalblue;
        background-color: transparent;
        text-decoration: none !important;
        font-size: 16px;
        font-weight: bold;
        padding-left: 25px;
    }

    #accordion-style-1 .card-body {
        /* border-top: 2px solid royalblue; */
    }

    #accordion-style-1 .card-header .btn.collapsed .fa.main{
        display:none;
    }

    #accordion-style-1 .card-header .btn .fa.main{
        background: royalblue;
        padding: 13px 11px;
        color: #ffffff;
        width: 35px;
        height: 41px;
        position: absolute;
        left: -1px;
        top: 10px;
        border-top-right-radius: 7px;
        border-bottom-right-radius: 7px;
        display:block;
    }
</style>
<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form @submit.prevent="createUser()" enctype="multipart/form-data">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">General Information</a>
                                <a class="nav-item nav-link" id="nav-personal_prof-tab" data-toggle="tab" href="#nav-personal_prof"  role="tab"  aria-controls="nav-personal_prof" aria-selected="false">Personal Information</a>
                                <a class="nav-item nav-link" id="nav-job_info-tab" data-toggle="tab" href="#nav-job_info"  role="tab"  aria-controls="nav-job_info" aria-selected="false">Job Information</a>
                                <a class="nav-item nav-link" id="nav-att_info-tab" data-toggle="tab" href="#nav-att_info" role="tab" aria-controls="nav-att_info" aria-selected="false">Attendance  Information</a>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row mt-4">
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label class="required" for="fist_name">First Name</label>
                                                            <input class="form-control"  v-model="form.first_name" type="text" name="fist_name" id="fist_name" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label for="sir_name">SurName</label>
                                                            <input class="form-control"  v-model="form.sir_name" type="text" name="sir_name" id="sir_name">
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label for="last_name">Last Name</label>
                                                            <input class="form-control"  v-model="form.last_name" type="text" name="last_name" id="last_name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-4">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="emp_picture">Employee Picture</label>
                                                            <div class="custom-file">
                                                                <input type="file" id="emp_picture" name="emp_picture" class="custom-file-input" data-multiple-files-text="%count% file(s)" data-locale="en">
                                                                <label class="custom-file-label" for="emp_picture">
                                                                    Choose file(s)
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="notes">Notes</label>
                                                            <textarea class="form-control" cols="30" type="text"  v-model="form.notes" name="notes" id="notes"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row mt-4">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="email" class="required">Email</label>
                                                            <input class="form-control"  v-model="form.email" type="text" name="email" id="email" required>

                                                        </div>
                                                        <div class="form-check pt-2 ml-3">
                                                            <input class="form-check-input" name="send_credentials" v-model="form.send_credentials" type="checkbox" value="" id="defaultCheck1">
                                                            <label class="form-check-label" for="defaultCheck1">
                                                                Send credentials to employee on email
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="status" class="required">status</label>
                                                            <select name="status" id="status"  v-model="form.status" class="form-control">
                                                                <option value="-1">choose</option>
                                                                <option value="1">Active</option>
                                                                <option value="2">Stopped</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-check pt-2 ml-3">
                                                            <input class="form-check-input" name="allow_access" v-model="form.allow_access" type="checkbox" value="" id="defaultCheck1">
                                                            <label class="form-check-label" for="defaultCheck1">
                                                                Allow access to the system
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-4">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="language" class="required">Language</label>
                                                            <select name="language"  v-model="form.language" id="language" class="form-control">
                                                                <option value="-1">choose</option>
                                                                <option value="1">Arabic</option>
                                                                <option value="2">English</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="roles" class="required">Role</label>
                                                            <select name="roles"  v-model="form.roles" id="roles" class="form-control">
                                                                <option value="-1">choose</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="nav-personal_prof" role="tabpanel" aria-labelledby="nav-personal_prof-tab">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row mt-4">
                                                    <div class="col-6 mt-3">
                                                            <div class="form-group">
                                                                <label class="required" for="date_of_birth">Date of Birth</label>
                                                                <input type="date" id="date_of_birth" name="date_of_birth"  v-model="form.date_of_birth" class="form-control" required>

                                                            </div>
                                                    </div>
                                                    <div class="col-6 mt-3">
                                                        <div class="form-group">
                                                            <label for="date_of_birth">Gender</label>
                                                            <select name="gender"  v-model="form.gender" id="gender" class="form-control">
                                                                <option value="-1">choose</option>
                                                                <option value="1">Male</option>
                                                                <option value="2">Female</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 mt-3">
                                                        <div class="form-group">
                                                            <label for="country" class="required">Country</label>
                                                            <select name="country"  v-model="form.country" id="country" class="form-control">
                                                                <option value="-1">choose</option>
                                                                <option value="1">Cairo</option>
                                                                <option value="2">Saudi Arabia</option>
                                                                <option value="3">Jordan</option>
                                                                <option value="4">Syria</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-6 mt-3">
                                                        <div class="form-group">
                                                            <label class="required" for="mobile_number">Mobile Number</label>
                                                            <input type="text" id="mobile_number"  v-model="form.mobile_number" name="mobile_number" class="form-control" required>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Accordion -->
                                    <div class="container-fluid bg-light" id="accordion-style-1">
                                        <div class="row">
                                            <div class="col-12 mx-auto">
                                                <div class="accordion mt-3" id="accordionExample">
                                                    <div class="card">
                                                        <div class="card-header" id="headingTwo">
                                                            <h5 class="mb-0">
                                                            <button class="btn btn-link collapsed btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                            <i class="fa fa-home main"></i><i class="fa fa-angle-double-right mr-3"></i>Present Address
                                                            </button>
                                                            </h5>
                                                        </div>
                                                        <div id="collapseTwo" class="collapse fade" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-6 mt-3">
                                                                            <div class="form-group">
                                                                                <label for="address">Address</label>
                                                                                <input type="text"  v-model="form.address" id="address" name="address" class="form-control">

                                                                            </div>
                                                                    </div>
                                                                    <div class="col-6 mt-3">
                                                                            <div class="form-group">
                                                                                <label for="city">City</label>
                                                                                <input type="text"  v-model="form.city" id="city" name="city" class="form-control">

                                                                            </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-6 mt-3">
                                                                        <div class="form-group">
                                                                            <label for="state">State</label>
                                                                            <input type="text" id="state"  v-model="form.state" name="state" class="form-control">

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-header" id="headingTwo">
                                                            <h5 class="mb-0">
                                                            <button class="btn btn-link collapsed btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                            <i class="fa fa-home main"></i><i class="fa fa-angle-double-right mr-3"></i>Permanent Address
                                                            </button>
                                                            </h5>
                                                        </div>
                                                        <div id="collapseThree" class="collapse fade" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-6 mt-3">
                                                                            <div class="form-group">
                                                                                <label for="address">Address</label>
                                                                                <input type="text" id="address" name="address" class="form-control">

                                                                            </div>
                                                                    </div>
                                                                    <div class="col-6 mt-3">
                                                                            <div class="form-group">
                                                                                <label for="city">City</label>
                                                                                <input type="text" id="city" name="city" class="form-control">

                                                                            </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-6 mt-3">
                                                                        <div class="form-group">
                                                                            <label for="state">State</label>
                                                                            <input type="text" id="state" name="state" class="form-control">

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- .// Accordion -->
                                </div>

                                <div class="tab-pane fade" id="nav-job_info" role="tabpanel" aria-labelledby="nav-job_info-tab">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row mt-4">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="designation">Designation</label>
                                                            <select name="designation" v-model="form.designation" id="designation" class="form-control">
                                                                <option value="-1">choose</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="department">Departments</label>
                                                            <select name="department" v-model="form.department" id="department" class="form-control">
                                                                <option value="-1">choose</option>
                                                                <option value="1">Sales</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 mt-3">
                                                        <div class="form-group">
                                                            <label for="emp_level">Employment Level</label>
                                                            <select name="emp_level" v-model="form.emp_level" id="emp_level" class="form-control">
                                                                <option value="-1">choose</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-6 mt-3">
                                                        <div class="form-group">
                                                            <label class="required" for="join_date">Join Date</label>
                                                            <input type="date" id="join_date" name="join_date" v-model="form.join_date" class="form-control" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 mt-3">
                                                        <div class="form-group">
                                                            <label for="branch" class="required">Branches</label>
                                                            <select name="branch" v-model="form.branch" id="branch" class="form-control">
                                                                <option value="-1">choose</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="nav-att_info" role="tabpanel" aria-labelledby="nav-att_info-tab">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row mt-4">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="attendance_shift">Attendance Shift</label>
                                                            <select name="attendance_shift" v-model="form.attendance_shift" id="attendance_shift" class="form-control">
                                                                <option value="-1">choose</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="leave_policy">Leave Policy</label>
                                                            <select name="leave_policy" v-model="form.leave_policy" id="leave_policy" class="form-control">
                                                                <option value="-1">choose</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 mt-3">
                                                        <div class="form-group">
                                                            <label for="holiday_lists">Holiday Lists</label>
                                                            <select name="holiday_lists" v-model="form.holiday_lists" id="holiday_lists" class="form-control">
                                                                <option value="-1">choose</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <div class="form-group pt-2 ml-3 float-right">
                                    <button class="btn btn-success" type="submit">Save</button>
                                    <button class="btn btn-danger"  type="button">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
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
                first_name:'',
                sir_name:'',
                last_name:'',
                notes:'',
                email:'',
                send_credentials:'',
                status:1,
                allow_access:'',
                language:2,
                date_of_birth:'',
                gender:-1,
                country:1,
                mobile_number:'',
                city:'',
                state:'',
                designation:-1,
                department:-1,
                join_date:'',
                emp_level:-1,
                branch:-1,
                attendance_shift:-1,
                leave_policy:-1,
                holiday_lists:-1,
            })
        }
    },
    methods:{
        // createUser(){
        //     this.$Progress.start();
        //     this.form.post('api/emp_general_info')
        //     .then(()=>{
        //         swal.fire({
        //             position: 'top-end',
        //             icon: 'success',
        //             title: 'User Created in successfully',
        //             showConfirmButton: false,
        //             timer: 1500
        //         })
        //     })
        //     this.$Progress.finish();
        // },
    },

    created() {
        //this.loadUsers(this.Global_employeeid);
    },
}
</script>
