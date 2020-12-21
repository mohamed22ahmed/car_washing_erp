<style>
/* styles reset */
/*.card-body.card {
  border:0;
}*/
/* card group aka PRIMARY */
.card-group .card-primary:hover {
  box-shadow: 0 40px 60px -20px rgba(12, 5, 62, 0.15);
  z-index: 100;
}
.card-group .card-primary:hover .card-title{
  color: #4e22d0;
}
.card-group .card-primary .card-img-top{
  width:200px;
  height:200px;
  margin: 80px auto 32px;
}
/*.card-group .card-primary .card-body > .badge {
  margin-bottom: 24px;
}
.card-group.card-group .card-primary .card-body {
  padding: 0 32px;
}*/
.card-group .card-primary .card-title {
  color: #261c6a;
  font-size: 26px;
  line-height: 1.54;
  font-weight: 900;
  margin-bottom: 24px;
}
.card-group .card-primary .card-text {
  color: #261c6a;
  font-size: 16px;
  line-height: 1.5;
  font-weight: 400;
}
.card-group .card-primary .card-body {
  padding: 48px 0 56px;
  background: transparent;
  border:0;
}

/* PAGE LAYOUT */
main{
  padding:0 20px;
  max-width:1361px;
  margin:0 auto;
}
h2 {
  margin-top: 40px;
}
</style>
<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">
                    <h2 class="pb-5">Settings</h2>
                    </div>
                    <div class="card-body">
                        <main>
                            <div class="card-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="card card-primary text-center">
                                            <img class="card-img-top" src="storage/holiday.png" alt="">
                                            <div class="card-body">
                                                <router-link :to="{ path:'/holiday_lists'}" class="btn btn-outline-primary btn-icon-right">
                                                    <span>Holiday Lists
                                                        <i class="fas fa-arrow-right ml-1"></i>
                                                    </span>
                                                </router-link>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="card card-primary text-center">
                                            <img class="card-img-top" src="storage/flag.png" alt="">
                                            <div class="card-body">
                                                <router-link :to="{ path:'/attendance_flag'}" class="btn btn-outline-primary btn-icon-right">
                                                    <span>Attendance Flag
                                                        <i class="fas fa-arrow-right ml-1"></i>
                                                    </span>
                                                </router-link>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="card card-primary text-center">
                                            <img class="card-img-top" src="storage/machine.png" alt="">
                                            <div class="card-body">
                                                <router-link :to="{ path:'/machines'}" class="btn btn-outline-primary btn-icon-right">
                                                    <span>Machines
                                                        <i class="fas fa-arrow-right ml-1"></i>
                                                    </span>
                                                </router-link>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="card card-primary text-center">
                                            <img class="card-img-top" src="storage/policy.png" alt="">
                                            <div class="card-body">
                                                <router-link :to="{ path:'/leave_policies'}" class="btn btn-outline-primary btn-icon-right">
                                                    <span>Leave Policies
                                                        <i class="fas fa-arrow-right ml-1"></i>
                                                    </span>
                                                </router-link>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </main>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
