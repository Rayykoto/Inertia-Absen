<template>
    <Head>
        <title>Master Absensi - Aplikasi Dashboard</title>
    </Head>
    <main class="c-main">
    <div class="container-fluid">
            <div class="fade-in">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-0 rounded-3 shadow border-top-purple">
                            <div class="card-header">
                                <span class="font-weight-bold"><i class="fa fa-chart-bar"></i> REPORT ABSENSI</span>
                            </div>
                            <div class="card-body">
                                <form @submit.prevent="proses">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">START DATE</label>
                                                <input type="date" v-model="start_date" class="form-control">
                                            </div>
                                            <div v-if="errors.start_date" class="alert alert-danger">
                                                {{ errors.start_date }}
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">END DATE</label>
                                                <input type="date" v-model="end_date" class="form-control">
                                            </div>
                                            <div v-if="errors.end_date" class="alert alert-danger">
                                                {{ errors.end_date }}
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="mb-3">
                                                <label class="form-label fw-bold text-white">*</label>
                                                <button class="btn btn-md btn-purple border-0 shadow w-100"><i class="fa fa-filter"></i> FILTER</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <div v-if="filters">
                                    <hr>
                                    <!-- <div class="export text-end mb-3">
                                        <a href="#" target="_blank" class="btn btn-success btn-md border-0 shadow me-3"><i class="fa fa-file-excel"></i> EXCEL</a>
                                        <a href="#" target="_blank" class="btn btn-secondary btn-md border-0 shadow"><i class="fa fa-file-pdf"></i> PDF</a>
                                    </div> -->
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr style="background-color: #e6e6e7;">
                                                <th scope="col">Nama</th>
                                                <th scope="col">Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="filter in filters" :key="filter.id">
                                                <td>{{ filter.user.name }}</td>
                                                <td>{{ filter.keterangan }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script>

import { Inertia } from '@inertiajs/inertia'

 import LayoutApp from '../../../Layouts/App.vue';

 import { Head, Link } from '@inertiajs/inertia-vue3';

 import Pagination from '../../../Components/Pagination.vue';

 import { ref } from 'vue';

export default{
    layout: LayoutApp,

    components:{
        Head,
        Link,
        Pagination
    },

    props:{
        // absens: Object,
        filters: Array,
        errors: Object
    },

    setup() {

        // const search = ref('' || (new URL(document.location)).searchParams.get('r'));

        //define state
            const start_date = ref('' || (new URL(document.location)).searchParams.get('start_date'));
            const end_date = ref('' || (new URL(document.location)).searchParams.get('end_date'));


            //define methods filter
            const proses = () => {
                
                //HTTP request
                Inertia.get('/apps/absensi/master/filter', {

                    //send data to server
                    start_date: start_date.value,
                    end_date: end_date.value,
                });

            }

            return {
                start_date,
                end_date,
                proses
            }

    }

}
</script>

<style>

</style>