<template>
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <router-link to="/" class="navbar-brand">Vue-SPA</router-link>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <template v-if="currentUser">
                        <li class="nav-item">
                            <router-link to="/customers" class="nav-link">Customers</router-link>
                        </li>
                    </template>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <template v-if="!currentUser">
                        <li class="nav-item">
                            <router-link to="/login" class="nav-link">Login</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/register" class="nav-link">Register</router-link>
                        </li>
                    </template>
                    <template v-else>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle"
                               href="#"
                               role="button"
                               data-toggle="dropdown"
                               aria-expanded="false" aria-haspopup="true">
                                {{ currentUser.name }} <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#!" @click.prevent="logout">Logout</a>
                            </div>
                        </li>
                    </template>
                </ul>
            </div>
        </div>
    </nav>
</template>
<script>
    export default {
        name: 'app-header',
        methods: {
            logout() {
                this.$store.commit('logout');
                this.$router.push('/login');
            }
        },
        computed: {
            currentUser() {
                return this.$store.getters.currentUser;
            }
        }
    }
</script>
