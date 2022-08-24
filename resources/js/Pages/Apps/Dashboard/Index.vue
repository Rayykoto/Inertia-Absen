<template>
    
    <Head>
        <title>DASHBOARD - Aplikasi Dashboard</title>
    </Head>

     <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">

                <div class="row">
                    <div class="col-md-3">
                        <div  class="card border-0 rounded-3 shadow border-top-purple">
                            <div class="card-header">
                                <span class="font-weight-bold"><i class="fa fa-chart-bar"></i> Absen Total Today</span>
                            </div>
                            <div class="card-body">
                                <h5 class="fw-bold"> {{ absen_today.total }} </h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">

                        <!-- <div class="card border-0 rounded-3 shadow border-top-info mb-4">
                            <div class="card-header">
                                <span class="font-weight-bold"><i class="fa fa-chart-line"></i> SALES TODAY</span>
                            </div>
                            <div class="card-body">
                                <strong>0</strong> SALES
                                <hr>
                                <h5 class="fw-bold">Rp. 0</h5>
                            </div>
                        </div> -->

                        <div v-if="hasAnyPermission(['dashboard.count_user'])" class="card border-0 rounded-3 shadow border-top-success">
                            <div class="card-header">
                                <span class="font-weight-bold"><i class="fa fa-chart-bar"></i> Total User</span>
                            </div>
                            <div class="card-body">
                                <h5 class="fw-bold"> {{ count_user }} </h5>
                            </div>
                        </div>

                    </div>
                </div>

    <div class="row">
        <div class="container-fluid">
            <div class="fade-in">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-0 rounded-3 shadow border-top-purple">
                            <div class="card-header">
                                <span class="font-weight-bold"><i class="fa fa-users"></i> Absen Today</span>
                            </div>
                            <div class="card-body">
                                <form> 
                                     <!-- <div class="input-group mb-3">
                                        <input type="text" v-model="search" class="form-control" placeholder="search by name...">
                                        <button class="btn btn-primary input-group-text" type="submit"> <i class="fa fa-search me-2"></i> SEARCH</button>
                                    </div>  -->
                                 </form>
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Full Name</th>
                                            <th scope="col">Jam Masuk</th>
                                            <th scope="col">Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(absen, index) in absen_today.data" :key="index">
                                            <td>{{ absen.user.name }}</td>
                                            <td>{{ new Date(absen.created_at).toLocaleString() }}</td>
                                            <td>{{ absen.keterangan }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <Pagination :links="absen_today.links" align="end"/>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
                <!-- <div class="row">
                    <div class="col-md-6">
                        <div class="card border-0 rounded-3 shadow border-top-warning">
                            <div class="card-header">
                                <span class="font-weight-bold"><i class="fa fa-chart-pie"></i> BEST SELIING PRODUCT</span>
                            </div>
                            <div class="card-body">

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-0 rounded-3 shadow border-top-danger">
                            <div class="card-header">
                                <span class="font-weight-bold"><i class="fa fa-box-open"></i> PRODUCT STOCK</span>
                            </div>
                            <div class="card-body">
                            </div>
                        </div>
                    </div>
                </div> -->

            </div>
        </div>
    </main>
</template>

<script>
    //import layout
    import LayoutApp from '../../../Layouts/App.vue';

    //import Heade and useForm from Inertia
    import { Head, Link } from '@inertiajs/inertia-vue3';

    import Pagination from '../../../Components/Pagination.vue';

    export default {

        //layout
        layout: LayoutApp,

        //register component
        components: {
            Head,
            Link,
            Pagination
        },
        
        props: {
            //total user
        count_user: Number,
        absen_today: Object
        }
    }
</script>

<style>

</style>