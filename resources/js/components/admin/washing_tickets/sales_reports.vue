<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{$t('86')}}</h3>
                        <div class="card-tools">
                            <button class="btn btn-info" @click="print">
                                <i class="fas fa-print fa-fw"></i>&nbsp; Print
                            </button>
                        </div>
                    </div>

                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="filters">{{ $t('134') }}</label>
                                <select name="filters" id="filters"  v-model="filter" class="form-control" @change="getResults">
                                    <option value="-1">{{ $t('135') }}</option>
                                    <option value="1">{{ $t('252') }}</option>
                                    <option value="2">{{ $t('246') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="card-body" id="print">
                        <div class="card-body table-responsive p-0">
                            <table class="table table-bordered table-hover text-center">
                            <thead class="thead-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Creation Date</th>
                                    <th>Employee Name</th>
                                    <th>Total Services</th>
                                    <th>Total Cost</th>
                                    <th>Total Taxes</th>
                                    <th>End Cost</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="sale in sales.data" :key="sale.id">
                                    <td>{{ sale.id }}</td>
                                    <td>{{ sale.ticket_date }}</td>
                                    <td>{{user}}</td>
                                    <td>{{ sale.totalServices }}</td>
                                    <td>{{ sale.totalSum }}</td>
                                    <td>0</td>
                                    <td>{{ endCost }}</td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                sales:{},
                user:'',
                endCost:'',
                filter:1,
                car_ticket:'',
                carpet_ticket:'',
                ticket_id:'',
            }
        },
        methods:{
            print(){
                this.$htmlToPaper('print');
            },

            getResults(page = 1) {
                this.sales={}
                axios.get('api/sales_reports/'+ this.filter+'?page=' + page).then((res) => {
                    this.sales = res.data;
                });
                this.get_user();
                this.get_total_cost();
            },
            get_user(){
                axios.get('api/get_user').then((res) => {
                    this.user = res.data;
                });
            },
            get_total_cost(){
                axios.get('api/get_total_cost/'+this.filter).then((res) => {
                    this.endCost = res.data;
                });
            },
        },
        created(){
            this.getResults();
        }
    }
</script>
