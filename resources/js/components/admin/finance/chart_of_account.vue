<template>
<div class="container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Chart OF Accounts
                        <div class="card-tools">
                            <button class="btn btn-success" @click="newModal">Add New<i class="fas fa-user-plus fa-fw"></i></button>
                        </div>
                    </div>
                    <mdb-treeview>
                        <mdb-treeview-item nested icon="desktop" title="أصول">
                            <mdb-treeview-item icon="desktop" title="Contact"/>
                            <mdb-treeview-item icon="desktop" title="Offer"/>
                            <mdb-treeview-item nested icon="desktop" title="Calendar">
                                <mdb-treeview-item icon="desktop" title="Deadlines"/>
                                <mdb-treeview-item icon="desktop" title="Meetings"/>
                                    <mdb-treeview-item nested icon="desktop" title="Calendar">
                                        <mdb-treeview-item icon="desktop" title="Workouts"/>
                                        <mdb-treeview-item icon="desktop" title="Events"/>
                                    </mdb-treeview-item>
                            </mdb-treeview-item>
                        </mdb-treeview-item>
                        <mdb-treeview-item nested icon="desktop" title="خصوم">
                            <mdb-treeview-item icon="desktop" title="Contact"/>
                            <mdb-treeview-item icon="desktop" title="Offer"/>
                            <mdb-treeview-item nested icon="desktop" title="Calendar">
                                <mdb-treeview-item icon="desktop" title="Deadlines"/>
                                <mdb-treeview-item icon="desktop" title="Meetings"/>
                                    <mdb-treeview-item nested icon="desktop" title="Calendar">
                                        <mdb-treeview-item icon="desktop" title="Workouts"/>
                                        <mdb-treeview-item icon="desktop" title="Events"/>
                                    </mdb-treeview-item>
                            </mdb-treeview-item>
                        </mdb-treeview-item>
                        <mdb-treeview-item nested icon="desktop" title="رأس المالية و حقوق الملكية">
                            <mdb-treeview-item icon="desktop" title="Contact"/>
                            <mdb-treeview-item icon="desktop" title="Offer"/>
                            <mdb-treeview-item nested icon="desktop" title="Calendar">
                                <mdb-treeview-item icon="desktop" title="Deadlines"/>
                                <mdb-treeview-item icon="desktop" title="Meetings"/>
                                    <mdb-treeview-item nested icon="desktop" title="Calendar">
                                        <mdb-treeview-item icon="desktop" title="Workouts"/>
                                        <mdb-treeview-item icon="desktop" title="Events"/>
                                    </mdb-treeview-item>
                            </mdb-treeview-item>
                        </mdb-treeview-item>
                        <mdb-treeview-item nested icon="desktop" title="الإيرادات">
                            <mdb-treeview-item icon="desktop" title="Contact"/>
                            <mdb-treeview-item icon="desktop" title="Offer"/>
                            <mdb-treeview-item nested icon="desktop" title="Calendar">
                                <mdb-treeview-item icon="desktop" title="Deadlines"/>
                                <mdb-treeview-item icon="desktop" title="Meetings"/>
                                    <mdb-treeview-item nested icon="desktop" title="Calendar">
                                        <mdb-treeview-item icon="desktop" title="Workouts"/>
                                        <mdb-treeview-item icon="desktop" title="Events"/>
                                    </mdb-treeview-item>
                            </mdb-treeview-item>
                        </mdb-treeview-item>
                        <mdb-treeview-item nested icon="desktop" title="المصروفات">
                            <mdb-treeview-item icon="desktop" title="Contact"/>
                            <mdb-treeview-item icon="desktop" title="Offer"/>
                            <mdb-treeview-item nested icon="desktop" title="Calendar">
                                <mdb-treeview-item icon="desktop" title="Deadlines"/>
                                <mdb-treeview-item icon="desktop" title="Meetings"/>
                                    <mdb-treeview-item nested icon="desktop" title="Calendar">
                                        <mdb-treeview-item icon="desktop" title="Workouts"/>
                                        <mdb-treeview-item icon="desktop" title="Events"/>
                                    </mdb-treeview-item>
                            </mdb-treeview-item>
                        </mdb-treeview-item>
                    </mdb-treeview>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title w-100 font-weight-bold py-2" v-show="!editmode" id="addNewLabel">Create Account</h5>
                        <h5 class="modal-title w-100 font-weight-bold py-2" v-show="editmode" id="addNewLabel">Update Account</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? updateUser() : createUser()">
                        <div class="modal-body">
                            <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="required" for="parent_account">Parent Account</label>
                                    <input class="form-control" v-model="form.parent_account" type="text" name="parent_account">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="account_number">Account Number</label>
                                    <input class="form-control" v-model="form.account_number" type="number" name="account_number">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="account_name">Account Name</label>
                                    <input class="form-control" v-model="form.account_name" type="text" name="account_name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="account_type">Account Type</label>
                                    <div>
                                        <select name="account_type" v-model="form.account_type" id="account_type" class="form-control">
                                            <option value="-1">choose</option>
                                            <option value="1">Main</option>
                                            <option value="2">Sub</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="balance_type">Balance Type</label>
                                    <div>
                                        <select name="balance_type" v-model="form.balance_type" id="balance_type" class="form-control">
                                            <option value="-1">choose</option>
                                            <option value="1">balance type one</option>
                                            <option value="2">balance type two</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="final_account">Final Account</label>
                                    <div>
                                        <select name="final_account" v-model="form.final_account" id="final_account" class="form-control">
                                            <option value="-1">choose</option>
                                            <option value="1">account one</option>
                                            <option value="2">account two</option>
                                        </select>
                                    </div>
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
    import {
        mdbContainer,
        mdbRow,
        mdbIcon,
        mdbTreeview,
        mdbTreeviewItem
} from "mdbvue";

    export default {
        name: "TreeviewPage",
        components: {
        mdbContainer,
        mdbRow,
        mdbIcon,
        mdbTreeview,
        mdbTreeviewItem
    },
    data: function() {
        return {
            editmode: false,
            form: new Form({
                account_name:'',
                account_type:1,
                balance_type:1,
                parent_account:'',
                account_number:'',
                final_account:1,
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
};
</script>
