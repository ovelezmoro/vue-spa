<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Login</div>
                    <div class="card-body">
                        <form @submit.prevent="authenticate">
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" v-model="form.email" class="form-control" name="email" required autofocus>

                                    <span class="text-danger" role="alert" v-if="authError">
                                        <strong>{{ authError }}</strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" v-model="form.password" class="form-control" name="password" required>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Login
                                    </button>
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
    import {login} from '../../helpers/auth'

    export default {
        name: 'login',
        data() {
            return {
                form: {
                    email: '',
                    password: ''
                },
                error: null
            }
        },
        methods: {
            authenticate() {
                this.$store.dispatch('login');
                login(this.$data.form)
                    .then((res) => {
                        this.$store.commit('loginSuccess', res);
                        this.$router.push({path: '/'})
                    })
                    .catch((err) => {
                        this.$store.commit('loginFailed', {err})
                    });
            }
        },
        computed: {
            authError() {
                return this.$store.getters.authError;
            }
        }
    }
</script>