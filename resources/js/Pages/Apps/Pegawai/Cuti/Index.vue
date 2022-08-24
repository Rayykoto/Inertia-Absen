<template>
    <Head>
        <title>Cuti - Aplikasi Dashboard</title>
    </Head>
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-0 rounded-3 shadow border-top-purple">
                            <div class="card-header">
                                <span class="font-weight-bold"><i class="fa fa-users"></i> CUTI PEGAWAI</span>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="input-group mb-3">

                                        <Link href="/apps/pegawai/cutis/create" class="btn btn-primary input-group-text"> <i class="fa fa-plus-circle me-2"></i> NEW</Link>

                                        <input type="text" v-model="search" class="form-control" placeholder="search by date...">

                                        <button class="btn btn-primary input-group-text" type="submit"> <i class="fa fa-search me-2"></i> SEARCH</button>
                                    </div>
                                </form>
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Deksripsi</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Waktu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(cuti, index) in cutispegawai.data" :key="index">
                                            <td>{{ cuti.user.name }}</td>
                                            <td>{{ cuti.alasan }}</td>
                                            <td>
                                                <span v-if="cuti.status == 'diterima'" class="badge badge-primary shadow border-0 ms-2 mb-2">   
                                                {{ cuti.status }}
                                                </span>
                                                <span v-if="cuti.status == 'ditolak'" class="badge badge-danger shadow border-0 ms-2 mb-2">   
                                                {{ cuti.status }}
                                                </span>
                                                <span v-if="cuti.status == 'diajukan'" class="badge badge-warning shadow border-0 ms-2 mb-2">   
                                                {{ cuti.status }}
                                                </span>
                                            </td>
                                            <td>{{ new Date(cuti.created_at).toLocaleString() }} - Sampai - {{ new Date().toLocaleString() }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <Pagination :links="cutispegawai.links" align="end"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
import LayoutApp from '../../../../Layouts/App.vue';

import Pagination from '../../../../Components/Pagination.vue';

import { Head, Link } from '@inertiajs/inertia-vue3';

import { ref } from 'vue';

import { Inertia } from '@inertiajs/inertia';

export default{ 
    layout: LayoutApp,

    components:{
        Head,
        Link,
        Pagination
    },

    props: {
        cutispegawai: Object,
        // ceks: Array
    }
}


</script>

<style>

</style>