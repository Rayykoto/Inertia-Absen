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
                                <span class="font-weight-bold"><i class="fa fa-users"></i> CUTI MASTER</span>
                            </div>
                            <div class="card-body">
                                <form @submit.prevent="handleSearch">
                                    <div class="input-group mb-3">
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
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(cuti, index) in cutis.data" :key="index">
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
                                            <td>{{ new Date(cuti.created_at).toLocaleString() }} - Sampai - {{ new Date(cuti.updated_at).toLocaleString() }}</td>
                                            <td class="text-center">
                                            <button v-if="cuti.status == 'diajukan'" @click.prevent="update(cuti.id)" class="btn btn-warning btn-sm"><i class="fa fa-check"></i> Accept</button>
                                            <button v-if="cuti.status == 'diajukan'" @click.prevent="rejected(cuti.id)" class="btn btn-danger btn-sm ms-3"><i class="fa fa-check"></i> Not Approve</button>
                                            <button v-if="cuti.status == 'diterima'" class="btn btn-success btn-sm"> Aproved</button>
                                            <button v-if="cuti.status == 'ditolak'" class="btn btn-danger btn-sm"> Reject</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <Pagination :links="cutis.links" align="end"/>
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

import Swal from 'sweetalert2';

export default{

    layout: LayoutApp,

    components:{
        Head,
        Link,
        Pagination
    },
    

    props:{
        cutis: Object
    },

    setup() {

        const search = ref('' || (new URL(document.location)).searchParams.get('q'));

        const handleSearch = () => {
            Inertia.get('/apps/admin/cutis', {

                q: search.value,

            });
        }

        const update = (id) => {

            Swal.fire({
                title: 'Are You Sure?',
                text: "You Won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes Approve it!'
            })
            .then((result) => {
                if(result.isConfirmed) {

                    Inertia.post(`/apps/admin/cutis/${id}`,{
                        _method: 'PUT'
                    });

                    Swal.fire({
                        title: 'Updated!',
                        text: 'Cuti Update sucessfully.',
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            })
        }

        const rejected = (id) => {

            Swal.fire({
                title: 'Are You Sure?',
                text: "You Won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes Rejected it!'
            })
            .then((result) => {
                if(result.isConfirmed) {

                    Inertia.post(`/apps/admin/cutis/reject/${id}`,{
                        _method: 'PUT'
                    });

                    Swal.fire({
                        title: 'Updated!',
                        text: 'Cuti Reject sucessfully.',
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            })
            
        }

        return {
            search,
            handleSearch,
            update,
            rejected
        }
    }
    

}

</script>