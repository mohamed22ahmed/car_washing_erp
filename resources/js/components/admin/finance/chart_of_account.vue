<style scoped>
button{
    color:white;
}
</style>
<template>
<div class="container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    <h3 class="card-title">{{ $t('122') }}</h3>
                        <div class="card-tools">
                            <button class="btn btn-success" @click="newModal">
                            <i class="fas fa-plus fa-fw"></i>&nbsp; {{ $t('102') }}</button>
                        </div>
                    </div>
                   <!-- <v-row>
                        <v-col cols="12" sm="12" md="5">
                            <v-text-field v-model="search" label="Search Company Directory" hide-details clearable clear-icon="mdi-close-circle-outline"></v-text-field>
                            <v-treeview :items="items" activatable active-class="primary lighten-3" v-model="tree" hoverable :active.sync="active_item" return-object>
                                <template v-slot:prepend="{ item }">
                                    <v-icon :color="item.account_type == 'sub' ? 'primary' : ''" v-text="
                                            `mdi-${
                                                item.account_type == 'main'
                                                    ? 'folder-network'
                                                    : 'file'
                                            }`
                                        "></v-icon>
                                    <v-chip small label>{{ item.id }}</v-chip>
                                </template>
                            </v-treeview>
                        </v-col>
                    </v-row>-->
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title w-100 font-weight-bold py-2" v-show="!editmode" id="addNewLabel">{{ $t('104') }} {{ $t('123') }}</h5>
                        <h5 class="modal-title w-100 font-weight-bold py-2" v-show="editmode" id="addNewLabel">{{ $t('105') }} {{ $t('123') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? updateUser() : createAccount()">
                        <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="col-sm-4 control-label">{{ $t('50') }}</label>
                                    <input type="text" v-model="form.name" name="name" placeholder="English Description" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                                    <has-error :form="form" field="name"></has-error>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="col-sm-4 control-label">{{ $t('56') }}</label>
                                    <input v-model="form.name_ar" type="text" name="name_ar" placeholder="Arabic Description" class="form-control" :class="{ 'is-invalid': form.errors.has('name_ar') }" dir="rtl">
                                    <has-error :form="form" field="name_ar"></has-error>
                                </div>
                            </div>
                        </div>

                            <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="account_type">{{ $t('127') }}</label>
                                    <div>
                                        <select name="account_type" v-model="form.account_type" id="account_type" class="form-control">
                                            <option value="-1">{{ $t('115') }}</option>
                                            <option value="1">{{ $t('130') }}</option>
                                            <option value="2">{{ $t('131') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="account_number">{{ $t('125') }}</label>
                                    <input class="form-control" v-model="form.account_number" type="number" name="account_number">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="required" for="parent_account">{{ $t('124') }}</label>
                                    <select v-model="form.parent_account" name="parent_account"  id="parent_account"  class="custom-select">
                                        <option value='0' selected="selected">No Any Dept</option>
                                        <option v-for="path in pathes" :key="path.id" :value="path.id">{{path.name}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="balance_type">{{ $t('128') }}</label>
                                    <div>
                                        <select name="balance_type" v-model="form.balance_type" id="balance_type" class="form-control">
                                            <option value="-1">{{ $t('115') }}</option>
                                            <option value="1">depit</option>
                                            <option value="2">credit</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="final_account">{{ $t('129') }}</label>
                                    <div>
                                        <select name="final_account" v-model="form.final_account" id="final_account" class="form-control">
                                            <option value="-1">{{ $t('115') }}</option>
                                            <option value="1">account one</option>
                                            <option value="2">account two</option>
                                        </select>
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
//mport { get } from "vuex-pathify";
export default {
    data: function() {
        return {
            pathes:{},
            accounts:{},
            editmode: false,
            form: new Form({
                account_id:'',
                account_type:1,
                balance_type:1,
                parent_account:'',
                account_number:'',
                final_account:1,
            }),
        }
    },

    methods:{
        loadAccounts(){
            this.form.get("api/chart_of_account").then((res)=>{
                this.accounts=res.data;
            })
        },

        get_full_pathes(){
            this.form.get("api/get_full_path").then((res)=>{
                this.pathes=res.data;
            })
        },

        createAccount(){
            this.$Progress.start();
            this.form.post('api/chart_of_account').then(()=>{
                Fire.$emit('AfterCreate');
                $('#addNew').modal('hide')
                swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Account Created successfully',
                    showConfirmButton: false,
                    timer: 1500
                })
                this.$Progress.finish();
            })
        },

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
    created(){
        this.loadAccounts()
        this.get_full_pathes();
        Fire.$on('AfterCreate',() => {
            this.loadAccounts();
            this.get_full_pathes();
        });
    }
};
</script>

<style lang="scss" scoped></style>
