<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">Role Permissions</div>

                    <div class="card-body">
                        <form @submit.prevent="set_permissions()">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="control-label">Role</label>
                                        <select class="form-control" id="role_id" name="role_id" v-model="form.role_id" @change="get_roles">
                                            <option v-for="role in roles" :key="role.id" :value="role.id">{{ role.name }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label">Module Name</label>
                                        <select class="form-control" id="module_id" name="module_id" v-model="module_id" @change="get_pages">
                                            <option v-for="mod in modules" :key="mod.module_id" :value="mod.module_id">{{ mod.module_name }}</option>
                                        </select>
                                    </div>
                                </div><hr>


                                <div class="row">
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover">
                                            <tbody>
                                                <tr>
                                                    <th>Page</th>
                                                    <th class="text-center">Save</th>
                                                    <th class="text-center">Update</th>
                                                    <th class="text-center">delete</th>
                                                </tr>
                                                <tr v-for="page in form.pages" :key="page.screen_name">
                                                    <td>{{ page.screen_name }}</td>
                                                    <td class="text-center" v-if="check_permission(page,1)!=''"><input type="checkbox" v-model="page.operation_type[1]"></td>
                                                    <td class="text-center" v-else></td>

                                                    <td class="text-center" v-if="check_permission(page,2)!=''"><input type="checkbox" v-model="page.operation_type[2]"></td>
                                                    <td class="text-center" v-else></td>

                                                    <td class="text-center" v-if="check_permission(page,3)!=''"><input type="checkbox" v-model="page.operation_type[3]"></td>
                                                    <td class="text-center" v-else></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Save</button>
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
            roles:{},
            modules:{},
            module_id:1,

            form: new Form({
                role_id:1,
                pages:{},
            }),
        }
    },

    methods: {
        get_roles(){
            axios.get('api/permission_roles').then((res)=>{
                this.roles=res.data
                this.get_modules()
            })
        },

        get_modules(){
            axios.get('api/permission_modules').then((res)=>{
                this.modules=res.data
                this.get_pages()
            })
        },

        get_pages(){
            axios.get('api/permissions_pages/'+this.form.role_id+"/"+this.module_id).then((res)=>{
                this.form.pages=res.data
            })
        },

        check_permission(page,per_id){
            var x='operation_type';
            for(var i=0;i<this.form.pages.length;i++){
                if(page.screen_name==this.form.pages[i]['screen_name']){
                    if(this.form.pages[i]['operation_type'][per_id]== undefined)
                        return '';
                    if(this.form.pages[i]['operation_type'][per_id]== true)
                        return 'found'
                    return 'notfound'
                }
            }
        },

        set_permissions(){
            this.form.post('api/permission').then(()=>{
                Fire.$emit('AfterCreate');
                swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Permissions assigned successfully',
                    showConfirmButton: false,
                    timer: 1500
                })
                this.$Progress.finish();
            })
        }
    },

    created() {
        this.get_roles()
        Fire.$on('AfterCreate', () => {
            this.get_roles();
        });
    },

}

</script>
