<template>
<Head>
    <title>Profile - Aplikasi Dashboard</title>
</Head>
<main class="c-main">
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0 rounded-3 shadow border-top-purple">
                        <div class="card-header">
                            <span class="font-weight-bold"><i class="fa fa-user"></i> Update Profile</span>
                        </div>
                        <div class="card-body">
                            <form @submit.prevent="submit">

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="fw-bold">Full Name</label>
                                            <input class="form-control" v-model="form.fullname" :class="{ 'is-invalid': errors.fullname}" type="text" placeholder="Full Name">
                                        </div>
                                        <div v-if="errors.fullname" class="alert alert-danger">
                                                {{ errors.fullname }}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="fw-bold">NIK</label>
                                            <input class="form-control" v-model="form.nik" :class="{ 'is-invalid': errors.nik}" type="number" placeholder="Number Identity">
                                        </div>
                                        <div v-if="errors.nik" class="alert alert-danger">
                                                {{ errors.nik }}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="fw-bold">Gender</label>
                                            <select class="form-select" v-model="form.gender">
                                                <option value="" disabled selected> Select your Gender </option>
                                                <option value="male"> Male </option>
                                                <option value="female"> Female </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <button class="btn btn-primary shadow-sm rounded-sm" type="submit">UPDATE</button>
                                        <button class="btn btn-warning shadow-sm rounded-sm ms-3" type="reset">RESET</button>
                                    </div>
                                </div>

                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="fade-in">
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0 rounded-3 shadow border-top-purple">
                        <div class="card-header">
                            <span class="font-weight-bold"><i class="fa fa-shield-alt"></i> Update Password</span>
                        </div>
                        <div class="card-body">
                            <form @submit.prevent="updatePassword">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="fw-bold"> Old Password</label>
                                            <input class="form-control" v-model="form.old_password" type="password" placeholder="Old Password">
                                        </div>
                                        <div v-if="errors.old_password" class="alert alert-danger">
                                                {{ errors.old_password }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="fw-bold">Password</label>
                                            <input class="form-control" v-model="form.password" type="password" placeholder="Password">
                                        </div>
                                        <div v-if="errors.password" class="alert alert-danger">
                                                {{ errors.password }}
                                        </div>
                                        </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="fw-bold">Password Confirmation</label>
                                            <input class="form-control" v-model="form.password_confirmation" type="password" placeholder="Password Confirmation">
                                        </div>
                                        <div v-if="errors.password_confirmation" class="alert alert-danger">
                                                {{ errors.password_confirmation }}
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <button class="btn btn-primary shadow-sm rounded-sm" type="submit">UPDATE</button>
                                        <button class="btn btn-warning shadow-sm rounded-sm ms-3" type="reset">RESET</button>
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

    components: {
        Head,
        Link
    },

    props: {
        errors: Object,
        profile: Object
    },

    setup(props) {

        const form = reactive({
            fullname: props.profile.fullname,
            nik: props.profile.nik,
            gender: props.profile.gender,
            old_password: '',
            password: '',
            password_confirmation: ''
        });

        const submit = () => {
            Inertia.post('/apps/pegawai/profiles', {
                fullname: form.fullname,
                nik: form.nik,
                gender: form.gender,
            }, {
                onSuccess: () => {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Profile updated Successfully.',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000
                    });
                },
            });
        }

        const updatePassword = () => {
            Inertia.put('/apps/pegawai/profiles/updatepassword', {
                old_password: form.old_password,
                password: form.password,
                password_confirmation: form.password_confirmation
            }, {
                onSuccess: () => {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Profile updated Successfully.',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000
                    });
                },
            });
        }

         return {
            form,
            submit,
            updatePassword
        }
    }

    
}

</script>