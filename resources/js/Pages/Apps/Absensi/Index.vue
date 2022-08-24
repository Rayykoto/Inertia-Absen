<template>
<Head>
    <title>Absensi - Aplikasi Dashboard</title>
</Head>

<main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card border-0 rounded-3 shadow border-top-purple">
                            <div class="card-header">
                                <span class="font-weight-bold"><i class="fa fa-fingerprint"></i> Absensi</span>
                            </div>
                            <div class="card-body">
                                <form @submit.prevent="prosesAbsen">
                                    <div class="input-group mb-3">
                                        <p v-if="dataabsen.waktu != 'dilarang'" class="text-center" >Hai, <b>{{ user.name }}</b> anda hari ini belum melakukan absen <b></b>. Silahkan lakukan absen pada tombol absen berikut <br><br>
                                        <input type="hidden" v-model="form.waktu">
                                        <button class="btn btn-primary" v-on:click="readRefs">Absen {{ dataabsen.waktu }} </button></p>
                                        <input type="hidden" v-model="form.lat" id="lat" ref="lat">
                                        <input type="hidden" v-model="form.long" id="long" ref="long">
                                        <p v-if="dataabsen.waktu == 'dilarang'" class="text-center">Hai, anda hari ini sudah melakukan absensi <b>Masuk</b> dan <b>Pulang</b></p>
                                    </div>
                                    <div v-if="errors.long" class="alert alert-danger">
                                        Gagal Absen, Silahkan Coba Lagi!
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
import LayoutApp from '../../../Layouts/App.vue';

import { Head, Link } from '@inertiajs/inertia-vue3';

import { onMounted, reactive } from 'vue';

import { Inertia } from '@inertiajs/inertia';

import Swal from 'sweetalert2';

getLocation();

        function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            alert("Geolocation is not supported by this browser");
        }

        function showPosition(position) {
            document.getElementById('lat').value = (position.coords.latitude);
            document.getElementById('long').value = (position.coords.longitude);
        }

    }

export default{
    layout: LayoutApp,

    components:{
        Head,
        Link
    },

    methods:{
        readRefs:function(){
            this.form.lat = this.$refs.lat.value;
            this.form.long = this.$refs.long.value
        }
    },

    props:{
        dataabsen: Object,
        user: Object,
        errors: Object
    },

    setup(props) {

        const form = reactive({
                waktu: props.dataabsen.waktu,
                lat: '',
                long: ''
        });

        const prosesAbsen = () => 

            Inertia.post('/apps/absensi', {
                keterangan: form.waktu,
                lat: form.lat,
                long: form.long
            },             
            {
                onSuccess: () => {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Success Absen!',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000
                    }).then((result) => {
                            if(result){
                            // Do Stuff here for success
                            location.reload();
                        }
                    });
                },
            });

        return{
            form,
            prosesAbsen
        }
    }
}

</script>

<style>

</style>