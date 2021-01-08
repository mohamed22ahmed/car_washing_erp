<style scoped>
    button{
        color:white;
    }
    .form-rounded {
        border-radius: 1rem;
    }
    .default{
        border-radius: 20px;
    }
    .form-control:focus {
    border-color: inherit;
    -webkit-box-shadow: none;
    box-shadow: none;
    }
    .verticalLine {
    border-left: thin solid black;
    }
    input[disabled][type='number']{
        /*color: rgb(0,0,0);*/
        background-color:lightblue;
    }
</style>

<template>
    <div class="container">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ $t('201') }}</h3>
                            <div class="card-tools">
                                <button class="btn btn-success" @click="newModal">
                                <i class="fas fa-plus fa-fw"></i>&nbsp; {{ $t('202') }}</button>
                                <button class="btn btn-info" @click="printForCarpet">
                                    <i class="fas fa-print fa-fw"></i>&nbsp; {{$t('212')}}
                                </button>
                            </div>
                        </div>

                        <div class="card-body" id="PrintCarpet">
                            <div class="card-body table-responsive p-0">
                                <table class="table table-bordered table-hover text-center">
                                <thead class="thead-light">
                                    <tr>
                                        <th>{{ $t('109') }}</th>
                                        <th>{{ $t('194') }}</th>
                                        <th>{{ $t('195') }}</th>
                                        <th>{{ $t('196') }}</th>
                                        <th>{{ $t('197') }}</th>
                                        <th>{{ $t('205') }}</th>
                                        <th>{{ $t('210') }}</th>
                                        <th>{{ $t('243') }}</th>
                                        <th>{{ $t('110') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="carpet in carpets.data" :key="carpet.id">
                                        <td>{{ carpet.id }}</td>
                                        <td>{{ carpet.client }}</td>
                                        <td>{{ carpet.id }}</td>
                                        <td>{{ carpet.num_of_materials }}</td>
                                        <td>{{ carpet.total_price }}</td>
                                        <td v-if="carpet.ticket_status==1"><span class="badge badge-danger">{{$t('238')}}</span></td>
                                        <td v-else-if="carpet.ticket_status==2"><span class="badge badge-warning">{{$t('239')}}</span></td>
                                        <td v-else-if="carpet.ticket_status==3"><span class="badge badge-info">{{$t('240')}}</span></td>
                                        <td v-else><span class="badge badge-success">{{$t('241')}}</span></td>
                                        <td>{{ carpet.receipt_date }}</td>
                                        <td>{{ carpet.expected_exit_date }}</td>
                                        <td>
                                            <a href="#" @click="editCarpet(carpet)">
                                                <i class="fa fa-edit"></i>
                                            </a>&nbsp;/
                                            <a href="#" @click="showCarpet(carpet.id)">
                                                <i class="fa fa-eye" style="color:green;"></i>
                                            </a>&nbsp;/
                                            <a href="#" @click="deleteCarpet(carpet.id)">
                                                <i class="fa fa-trash" style="color:red;"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                            <div class="card-footer">
                                <pagination :data="carpets" @pagination-change-page="getResults"></pagination>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-center">
                        <span class="badge badge-pill badge-success">{{ form.client_status }}</span>
                        <button type="button" class="close" style="color:black;" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form @submit.prevent="editmode ? updateUser() : createUser()">
                        <div class="modal-body bg-light">
                           <div class="row">
                                <div class="col-md-2">
                                   <h5><span class="badge badge-pill badge-secondary">{{ form.serial_number }}</span></h5>
                                </div>

                                <div class="col-md-3">
                                    <input v-model="form.ticket_date" type="text" name="ticket_date" :placeholder="ticket_date" onblur="(this.type='text')" onfocus="(this.type='date')" class="form-control form-rounded" :class="{ 'is-invalid': form.errors.has('ticket_date') }">
                                    <has-error :form="form" field="ticket_date"></has-error>
                                </div>

                                <div class="col-md-1"></div>

                                <div class="col-md-3">
                                   <select class="form-control form-rounded" name="wash" v-model="form.wash">
                                        <option selected value="-1">{{$t('204')}}</option>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                     <select class="form-control form-rounded" name="ticket_status" v-model="form.ticket_status">
                                        <option selected value="-1">{{$t('205')}}</option>
                                        <option selected value="1">{{$t('238')}}</option>
                                        <option selected value="2">{{$t('239')}}</option>
                                        <option selected value="3">{{$t('240')}}</option>
                                        <option selected value="4">{{$t('241')}}</option>
                                    </select>
                                </div>
                           </div>

                           <div class="row mt-3">
                                <div class="col-md-2">
                                   <select class="form-control form-rounded" name="client" v-model="form.client">
                                        <option selected value="-1">{{$t('206')}}</option>
                                    </select>
                                </div>
                                <div class="col-md-1 mt-1" style="margin-left:-7px; width">
                                    <button class="btn btn-sm btn-success default">
                                    <i class="fas fa-plus"></i></button>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input v-model="form.phone_number" type="text" name="phone_number" :placeholder="phone_number" class="form-control form-rounded" :class="{ 'is-invalid': form.errors.has('phone_number') }">
                                        <has-error :form="form" field="phone_number"></has-error>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                   <select class="form-control form-rounded" name="carpet_size" v-model="form.carpet_size">
                                        <option selected value="-1">{{$t('208')}}</option>
                                        <option v-for="size in sizes" :key="size.sys_code" :value="size.sys_code">{{ size.name }}</option>
                                    </select>
                                </div>
                                <div class="col-md-1 mt-1" style="margin-left:-7px; width">
                                    <button type="button" class="btn btn-sm btn-success default" @click="newCode_tableModal(4)">
                                    <i class="fas fa-plus"></i></button>
                                </div>

                                <div class="col-md-2">
                                   <select class="form-control form-rounded" name="wash_type" v-model="form.wash_type">
                                        <option selected value="-1">{{ $t('209') }}</option>
                                        <option v-for="type in types" :key="type.sys_code" :value="type.sys_code">{{ type.name }}</option>
                                    </select>
                                </div>
                                <div class="col-md-1 mt-1" style="margin-left:-7px; width">
                                    <button type="button" class="btn btn-sm btn-success default" @click="newCode_tableModal(5)">
                                    <i class="fas fa-plus"></i></button>
                                </div>
                           </div>


                            <div class="row mt-3  d-flex justify-content-center">
                                <div class="col-md-12">
                                    <div class="card card-default">
                                        <div class="card-body">
                                            <div class="table-responsive p-0">
                                                <form @submit.prevent="createMaterial()">
                                                    <table class="table text-center">
                                                        <thead>
                                                            <tr>
                                                                <th>{{ $t('229') }}</th>
                                                                <th>{{ $t('227') }}</th>
                                                                <th>{{ $t('228') }}</th>
                                                                <th>{{ $t('244') }}</th>
                                                                <th>{{ $t('230') }}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <select class="form-control" name="product_id" v-model="serviceForm.product_id" @change="get_services">
                                                                        <option v-for="pro in products" :key="pro.id" :value="pro.id">{{ pro.name }}</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select class="form-control" name="unit_id" v-model="serviceForm.unit_id" @change="get_cost">
                                                                        <option v-for="unt in units" :key="unt.id" :value="unt.id">{{ unt.name }}</option>
                                                                    </select>
                                                                </td>
                                                                <td><input  type="number" class="form-control" name="cost" disabled :value="serviceForm.cost"></td>
                                                                <td><input  type="number" class="form-control" name="extra_cost" :value="serviceForm.extra_cost"></td>
                                                                <td><button type="submit" class="btn btn-sm btn-info">{{$t('133')}}</button></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </form>
                                            </div>
                                        </div>
                                        <table class="table text-center">
                                            <tbody v-for="mat in materials.data" :key="mat.id">
                                                <tr>
                                                    <td>{{mat.name}}</td>
                                                    <td>{{mat.units}}</td>
                                                    <td>{{mat.cost}}</td>
                                                    <td>
                                                        <a href="#" @click="deleteMaterial(mat.id)">
                                                            <i class="fa fa-trash" style="color:red;"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <div class="d-flex justify-content-center">
                                                <pagination :data="materials" @pagination-change-page="getMaterials"></pagination>
                                            </div>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row d-flex justify-content-center">
                                <div class="col-sm-4">
                                    <label for="total_cost">{{$t('245')}}</label>
                                    <input type="number" class="form-control" disabled name="total_cost" :value="serviceForm.total_cost">
                                </div>

                                <div class="col-sm-4">
                                    <label for="total_materials">{{$t('196')}}</label>
                                    <input type="number" class="form-control" disabled name="total_materials" :value="serviceForm.total_materials">
                                </div>
                            </div>

                           <div class="row mt-3">
                                <div class="col-md-2"></div>

                                <div class="col-md-4">
                                    <input v-model="form.receipt_date" type="text" name="Time of receipt" :placeholder="entrance_date" onblur="(this.type='text')" onfocus="(this.type='date')" class="form-control form-rounded" :class="{ 'is-invalid': form.errors.has('receipt_date') }">
                                    <has-error :form="form" field="receipt_date"></has-error>
                                </div>

                                <div class="col-md-4">
                                    <input v-model="form.expected_exit_date" type="text" name="expected_exit_date" :placeholder="expected_exit_date" onblur="(this.type='text')" onfocus="(this.type='date')" class="form-control form-rounded" :class="{ 'is-invalid': form.errors.has('expected_exit_date') }">
                                    <has-error :form="form" field="expected_exit_date"></has-error>
                                </div>
                           </div>
                        </div>

                        <div class="modal-footer d-flex justify-content-center">
                            <button v-show="!editmode" type="submit" class="btn btn-success default mr-3">{{ $t('104') }}</button>
                            <button v-show="editmode" type="submit" class="btn btn-success default mr-3">{{ $t('105') }}</button>
                            <button v-show="editmode" type="button" class="btn btn-success default mx-3" @click="printForTicket">{{ $t('212') }}</button>
                            <button type="button" class="btn btn-success default mx-3">{{ $t('213') }}</button>
                            <button type="button" class="btn btn-success default mx-3">{{ $t('214') }}</button>
                            <button type="button" class="btn btn-success default mx-3">{{ $t('215') }}</button>
                            <button type="button" class="btn btn-danger default ml-3"  data-dismiss="modal">{{ $t('114') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Codetable_Modal -->
        <div class="modal fade" id="codeTableModal" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title w-100 font-weight-bold py-2" v-show="!editmode" id="addNewLabel">{{ $t('102') }}</h5>
                        <h5 class="modal-title w-100 font-weight-bold py-2" v-show="editmode" id="addNewLabel">{{ $t('105') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="createNew">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>{{ $t('50') }}</label>
                                <input v-model="code_tableForm.sys_code_type" type="hidden" name="sys_code_type">
                                <input v-model="code_tableForm.name" type="text" name="name" placeholder="English Description" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>{{ $t('56') }}</label>
                                <input v-model="code_tableForm.name_ar" type="text" name="name_ar" placeholder="الاسم بالعربية" class="form-control" dir="rtl">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button v-show="!editmode" type="submit" class="btn btn-success">{{ $t('121') }}</button>
                            <button v-show="editmode" type="submit" class="btn btn-success">{{ $t('105') }}</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">{{ $t('114') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- showTicket_Modal -->
        <div class="modal fade" id="showTicket" tabindex="-1" role="dialog" aria-labelledby="showTicketLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center w-100 font-weight-bold py-2" v-show="!editmode" id="showTicketLabel">{{ $t('246') }}</h5>
                        <button type="button" style="color:black;" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="PrintTicket">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>{{ $t('247') }}</th>
                                    <td>
                                        {{ ticket.serial_number }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ $t('194') }}</th>
                                    <td>
                                        {{ ticket.client }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ $t('207') }}</th>
                                    <td>
                                        {{ ticket.phone_number }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ $t('195') }}</th>
                                    <td>
                                        {{ ticket.id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ $t('248') }}</th>
                                    <td>
                                        {{ ticket.wash_type }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ $t('251') }}</th>
                                    <td>
                                        {{ ticket.carpet_size }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ $t('196') }}</th>
                                    <td>
                                        {{ ticket.num_of_materials }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ $t('197') }}</th>
                                    <td>
                                        {{ ticket.total_price }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ $t('205') }}</th>
                                    <td v-if="ticket.ticket_status==1"><span class="badge badge-danger">{{$t('238')}}</span></td>
                                    <td v-else-if="ticket.ticket_status==2"><span class="badge badge-warning">{{$t('239')}}</span></td>
                                    <td v-else-if="ticket.ticket_status==3"><span class="badge badge-info">{{$t('240')}}</span></td>
                                    <td v-else><span class="badge badge-success">{{$t('241')}}</span></td>
                                </tr>
                                <tr>
                                    <th>{{ $t('203') }}</th>
                                    <td>
                                        {{ ticket.ticket_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ $t('210') }}</th>
                                    <td>
                                        {{ ticket.receipt_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ $t('243') }}</th>
                                    <td>
                                        {{ ticket.expected_exit_date }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                    <button class="btn btn-info" @click="print"><i class="fas fa-print fa-fw"></i>&nbsp; {{$t('212')}}</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">{{ $t('114') }}</button>
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
                carpets :{},
                sizes:{},
                types:{},
                products:{},
                units:{},
                materials:{},
                ticket:{},
                form: new Form({
                    id:'',
                    serial_number :-1,
                    ticket_date:new Date().toISOString().slice(0, 10),
                    wash:-1,
                    ticket_status:1,
                    client:-1,
                    phone_number:'',
                    carpet_size:-1,
                    wash_type:-1,
                    receipt_date:'',
                    expected_exit_date:'',
                    total_price:'',
                    num_of_materials:'',
                    client_status:'good client',
                }),
                type_x:2,
                serviceForm:new Form({
                    id:'',
                    ticket_id:'',
                    type:'',
                    product_id:'',
                    unit_id:'',
                    cost:0,
                    extra_cost:0,
                    total_cost:0,
                    total_materials:0,
                }),

                code_tableForm:new Form({
                    sys_code_type:'',
                    sys_code:'',
                    name:'',
                    name_ar:'',
                })
            }
        },

        methods: {
            print(){
                this.$htmlToPaper('PrintTicket');
            },

            printForTicket(){
                this.form.get('api/carpet_wash_show/'+this.form.id).then((response) => {
                    this.ticket = response.data;
                });
                $('#showTicket').modal('show');
            },

            printForCarpet(){
                this.$htmlToPaper('PrintCarpet');
            },

            getResults(page = 1) {
                axios.get('api/carpet_wash/?page=' + page).then((response) => {
                    this.carpets = response.data;
                });
                axios.get('api/car_washing/4').then((res) => {
                    this.sizes=res.data
                        if(res.data!=[])
                            this.form.carpet_size=res.data[0]['sys_code']
                });
                axios.get('api/car_washing/5').then((res) => {
                    this.types=res.data
                        if(res.data!=[])
                            this.form.wash_type=res.data[0]['sys_code']
                });
                this.get_services();
            },

            get_serial(){
                axios.get('api/get_carpet_serial').then((res) => {
                    this.form.serial_number = res.data;
                });
            },

            getMaterials(page = 1) {
                if(this.form.id!='')
                axios.get('api/carpet_material/'+this.form.id+'/2?page=' + page).then((res) => {
                    this.materials = res.data;
                });
            },

            getId(){
                axios.get('api/carpet_washing_get_id').then((res) => {
                    this.form.id = res.data
                });
            },

            get_product_manages(){
                axios.get('api/carpet_washing_get_product_manages').then((res) => {
                    this.products = res.data
                });
            },

            get_services(){
                axios.get('api/carpet_washing_get_units/'+this.serviceForm.product_id).then((res) => {
                    this.units = res.data
                });
            },

            get_cost(){
                axios.get('api/carpet_washing_get_cost/'+this.serviceForm.unit_id).then((res) => {
                    this.serviceForm.cost = res.data
                });
            },

            getCodeTable() {
                axios.get('api/car_washing/' + this.code_tableForm.sys_code_type).then((res) => {
                    if(this.code_tableForm.sys_code_type==4){
                        this.sizes=res.data
                        if(res.data!=[])
                        this.form.carpet_size=res.data[0]['sys_code']
                    }
                    else if(this.code_tableForm.sys_code_type==5){
                        this.types=res.data
                        if(res.data!=[])
                        this.form.wash_type=res.data[0]['sys_code']
                    }
                });
            },

            newCode_tableModal(x){
                this.code_tableForm.reset();
                this.code_tableForm.sys_code_type=x
                $('#codeTableModal').modal('show');
            },

            createNew(){
                this.code_tableForm.post('api/car_washing_add_code_table').then(()=>{
                    Fire.$emit('AfterCreateCode_table');
                    $('#codeTableModal').modal('hide')
                    swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Item Created successfully',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    this.$Progress.finish();
                })
            },

            newModal(){
                this.editmode = false;
                this.form.reset();
                this.get_serial()
                $('#addNew').modal('show');
                this.getId()
            },

            newStatus(){
                this.editmode = false;
                this.form.reset();
                $('#addNew').modal('show');
            },

            createUser(){
                this.$Progress.start();
                this.form.post('api/carpet_wash').then(()=>{
                    Fire.$emit('AfterCreate');
                    $('#addNew').modal('hide')
                    swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Data Created successfully',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    this.$Progress.finish();
                })
            },

            editCarpet(user){
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(user);
                this.getMaterials();
            },

            updateUser(){
                this.$Progress.start();
                this.form.put('api/carpet_wash/'+this.form.id).then(() => {
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

            deleteCarpet(id){
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
                        this.form.delete('api/carpet_wash/'+id).then(()=>{
                            swal.fire(
                                'Deleted!',
                                'Data has been deleted.',
                                'success'
                            )
                            Fire.$emit('AfterCreate');
                        }).catch(()=> {
                            swal.fire("Failed!", "This data assigned to an employee.", "warning");
                        });
                    }
                })
            },

            showCarpet(id){
                $('#showTicket').modal('show');
                this.form.get('api/carpet_wash_show/'+id).then((response) => {
                    this.ticket = response.data;
                });
            },

            createMaterial(){
                this.serviceForm.type=this.type_x
                this.serviceForm.ticket_id=this.form.id
                this.$Progress.start();
                this.serviceForm.post('api/carpet_material').then(()=>{
                    Fire.$emit('AfterCreateInside');
                    this.serviceForm.reset()
                })
            },

            deleteMaterial(id){
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
                        this.serviceForm.delete('api/carpet_material/'+id).then(()=>{
                            Fire.$emit('AfterCreateInside');
                        }).catch(()=> {
                            swal.fire("Failed!", "This data assigned to an employee.", "warning");
                        });
                    }
                })
            },
        },

        created(){
            this.get_product_manages();
            this.getResults();
            Fire.$on('AfterCreate',() => {
                this.getResults();
            });

            Fire.$on('AfterCreateCode_table',() => {
                this.getCodeTable();
            });

            Fire.$on('AfterCreateInside',() => {
                this.getMaterials();
            });
        },

        computed: {
            ticket_date() {
                return this.$t('203')
            },

            phone_number() {
                return this.$t('207')
            },

            entrance_date() {
                return this.$t('210')
            },

            expected_exit_date() {
                return this.$t('211')
            },
        }
    }
</script>
