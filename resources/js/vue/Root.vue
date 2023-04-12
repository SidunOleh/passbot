<template>
    <div class="wrapper min-vh-100 d-flex flex-column">
        <header v-if="!isLogin" class="header bg-light">
            <div class="container">
                <div class="header__body">
                    <nav class="navbar navbar-light">
                        <router-link :to="{name: 'sites.index'}" class="navbar-brand mb-0 h1">PASS BOT</router-link>
                        <a @click.prevent="logoutUser" class="navbar-brand" href="/">
                            Logout
                        </a>
                    </nav>
                </div>
            </div>
        </header>
        <main class="main flex-grow-1 pt-3 pb-3">
            <router-view />
        </main>
        <footer v-if="!isLogin" class="footer text-center bg-light p-3">
            SOVA @ {{ new Date().getFullYear() }}
        </footer>
    </div>
</template>

<script>
import axios from 'axios';
import router from '../router';

export default {
    computed: {
        isLogin() {
            return this.$route.name == 'auth.login'
        }
    },
    methods: {
        logoutUser() {
            axios.post('/logout')
                .then(res => {
                    localStorage.removeItem('auth')
                    router.push({name: 'auth.login'})
                })
        },
    },
}
</script>