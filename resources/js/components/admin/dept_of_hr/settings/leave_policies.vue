<style>
.pt-3-half {
    padding-top: 1.4rem;
}
</style>
<template>
    <div class="container">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">{{ $t('81') }}
                            <div class="card-tools">
                                <button class="btn btn-success" @click="newModal">
                                    <i class="fas fa-plus fa-fw"></i>&nbsp; {{ $t('82') }}
                                </button>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="card-body table-responsive p-0">
                            <table class="table table-bordered table-hover text-center">
                                <thead class="thead-light">
                                        <tr>
                                            <th>{{ $t('108') }}</th>
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
                        <h5 class="modal-title w-100 font-weight-bold py-2" v-show="!editmode" id="addNewLabel">{{ $t('82') }}</h5>
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
                                                <label for="name">{{ $t('50') }} <span style="color:red">*</span></label>
                                                 <input type="text" placeholder="Ex: leave policy 1" class="form-control" v-model="form.name" name="name" id="name">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="status" class="required">{{ $t('18') }} <span style="color:red">*</span></label>
                                                <select name="status" v-model="form.status" id="status" class="form-control">
                                                    <option value="1">{{ $t('19') }}</option>
                                                    <option value="2">{{ $t('20') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea class="form-control" id="description" name="description" v-model="form.description" rows="3"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-head bg-light">
                                        <span>Allocations</span>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div id="table" class="table-editable">
                                            <span class="table-add float-right mb-3 mr-2">Add new line<a @click="tableInsert" href="#!" class="text-success"><i
                                            class="fas fa-plus mx-2" aria-hidden="true"></i></a></span>
                                            <table class="table table-bordered table-responsive-md text-center">
                                            <thead class="thead-light">
                                                <tr >
                                                    <th class="text-center">Leave Type</th>
                                                    <th class="text-center">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="hide">
                                                    <td class="pt-3-half">
                                                    <div class="form-group">
                                                        <select name="leave_type" v-model="form.leave_type" id="leave_type" class="form-control">
                                                            <option value="-1">Select Leave Type</option>
                                                        </select>
                                                    </div>
                                                    </td>
                                                    <td>
                                                        <span class="table-remove"><button type="button"
                                                            class="btn btn-danger btn-rounded btn-sm my-0">delete</button>
                                                        </span>
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
                name:'',
                description:'',
                leave_type:-1,
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

        tableInsert(){
            const $tableID = $('#table');
            const $BTN = $('#export-btn');
            const $EXPORT = $('#export');
            const newTr = `
            <tr class="hide">
            <td class="pt-3-half" contenteditable="true">
            <div class="form-group">
                <label for="status" class="required">Status*</label>
                <select name="status" v-model="form.status" id="status" class="form-control">
                    <option value="1">Active</option>
                    <option value="2">Inactive</option>
                </select>
            </div>
            </td>
            <td>
                <span class="table-remove"><button type="button" class="btn btn-danger btn-rounded btn-sm my-0 waves-effect waves-light">Remove</button></span>
            </td>
            </tr>`;

            $('.table-add').on('click', 'i', () => {
            const $clone = $tableID.find('tbody tr').first().clone(true).removeClass('hide table-line');
            if ($tableID.find('tbody tr').length === 0) {
                $('tbody').append(newTr);
            }
            $tableID.find('table').append($clone);
            });
            $tableID.on('click', '.table-remove', function () {
            $(this).parents('tr').detach();
            });
            // A few jQuery helpers for exporting only
            jQuery.fn.pop = [].pop;
            jQuery.fn.shift = [].shift;
            $BTN.on('click', () => {
            const $rows = $tableID.find('tr:not(:hidden)');
            const headers = [];
            const data = [];
            // Turn all existing rows into a loopable array
            $rows.each(function () {
                const $td = $(this).find('td');
                const h = {};
                // Use the headers from earlier to name our hash keys
                headers.forEach((header, i) => {
                h[header] = $td.eq(i).text();
                });
                data.push(h);
            });
            // Output the result
            $EXPORT.text(JSON.stringify(data));
            });
        }
    },
}
</script>
