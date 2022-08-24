<template>
    <Head>
        <tittle>Forgot Password - Aplikasi Dashboard</tittle>
    </Head>
    <div class="col-md-4">
        <div class="fade-in">
            <div class="text-center mb-4">
                <a href="" class="text-dark text-decoration-none">
                    <img src="/images/-.png" width="70">
                    <h3 class="mt-2 font-weight-bold">APLIKASI DASHBOARD</h3>
                </a>
            </div>
            <div class="card-group">
                <div class="card border-top-purple border-0 shadow-sm rounded-3">
                    <div class="card-body">
                        <div class="text-start">
                            <h5>RESET PASSWORD</h5>
                        </div>
                        <hr>
                        <div v-if="session.status" class="alert alert-success mt-2">
                            {{ session.status }}
                        </div>
                        <form @submit.prevent="submit">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-envelope"></i>
                                    </span>
                                </div>
                                <input class="form-control" v-model="form.email" :class="{ 'is-invalid': errors.email }" type="email" placeholder="Email Address">
                            </div>
                            <div v-if="errors.email" class="alert alert-danger">
                                {{ errors.email }}
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button class="btn btn-primary shadow-sm rounded-sm px-4 w-100" type="submit"> SEND PASSWORD RESET LINK </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    //import layout 
    import LayoutAuth from '../../Layouts/Auth.vue';

    //import reactive
    import { reactive } from 'vue';

    //inertia penghubung
    import { Inertia } from '@inertiajs/inertia';

    //import Header and useForm from Inertia
    import {
        Head,
        Link
    } from '@inertiajs/inertia-vue3';

    export default {

        //ini memanggil import layout yg diatas
        layout: LayoutAuth,

        //ini memanggil import Header from inertia
        components: {
            Head,
            Link
        },

        props:{
            errors: Object,
            session: Object
        },

        setup(){
        //define form state
        const form = reactive({
            email: '',
        });

        const submit = () => {
            Inertia.post('/forgot-password', {
                email: form.email
            });
        }

        //return form state and submit methode
        return {
            form,
            submit,
        };

        }

    }

</script>