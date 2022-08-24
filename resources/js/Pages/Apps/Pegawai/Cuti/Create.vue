<template>
    <Head>
        <title>Create - Aplikasi Dashboard</title>
    </Head>
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-0 rounded-3 shadow border-top-purple">
                            <div class="card-header">
                                <span class="font-weight-bold"><i class="fa fa-shield-alt"></i> ADD CUTI</span>
                            </div>
                            <div class="card-body">
                                
                                <form @submit.prevent="submit">
                                    <div class="mb-3">
                                        <label class="fw-bold">Jenis Cuti</label>
                                        <select class="form-select" v-model="form.jenis_cuti">
                                            <option disabled :value="null"> Cuti </option>
                                            <option value="izin"> Izin </option>
                                            <option value="sakit"> Sakit </option>
                                            <option value="tlibur"> Tukar Libur </option>
                                        </select>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="fw-bold">Tanggal Mulai</label>
                                                <input class="form-control" type="date" v-model="form.mulai">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="fw-bold">Tanggal Akhir</label>
                                                <input class="form-control" type="date" v-model="form.akhir">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="fw-bold">Upload Image</label>
                                        <input class="form-control" type="file">
                                    </div>

                                    <div class="mb-3">
                                        <label class="fw-bold">Description</label>
                                        <textarea class="form-control" v-model="form.alasan" type="text" rows="4" placeholder="Description"></textarea>
                                    </div>

                                    <hr>

                                    <div class="row">
                                        <div class="col-12">
                                            <button class="btn btn-primary shadow-sm rounded-sm" type="submit">SAVE</button>
                                            <button class="btn btn-warning shadow-sm rounded-sm" type="reset">RESET</button>
                                        </div>
                                    </div>
                                </form>

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

import { Head, Link } from '@inertiajs/inertia-vue3';

import { reactive } from 'vue';

import { Inertia } from '@inertiajs/inertia';

import Swal from 'sweetalert2';

export default{
layout: LayoutApp,

components:{
            Head,
            Link
        },

    props:{
        errors: Object
        },

    setup(){
        
        const form = reactive({
            jenis_cuti: 'null',
            mulai: '',
            akhir: '',
            alasan: ''
        });

        const submit = () => 

                Inertia.post('/apps/pegawai/cutis', {
                    jenis_cuti: form.jenis_cuti,
                    mulai: form.mulai,
                    akhir: form.akhir,
                    alasan: form.alasan
                }, {
                onSuccess: () => {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Cuti Saved Sucessfully.',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000
                    });
                },
            });


        return {
            form,
            submit
        }
    }


}

</script>

<style>

</style>