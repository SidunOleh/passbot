<template>
    <section class="login">
        <div class="container">
            <div class="login__body vh-100 d-flex justify-content-center align-items-center">
                <form @submit.prevent="loginUser">
                    <div v-if="error" class="error alert alert-danger">
                        {{ error }}
                    </div>
                    <div class="form-group mb-3">
                        <label for="login">Login</label>
                        <input v-model="login" type="text" class="form-control" id="login" placeholder="Enter login">
                    </div> 
                    <div class="form-group mb-3">
                        <label for="password">Password</label>
                        <input v-model="password" type="password" class="form-control" id="password" placeholder="Enter password">
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </section>
</template>

<script>
import axios from 'axios';
import router from '../../router';

export default {
    data() {
        return {
            login: '',
            password: '',
            error: '',
        }
    },
    methods: {
        loginUser() {
            axios.get('/sanctum/csrf-cookie')
                .then(res => {
                    axios.post('/login', {
                        login: this.login,
                        password: this.password,
                    }).then(res => {
                        localStorage.setItem('auth', true)
                        router.push({name: 'sites.index'})
                    }).catch(err => {
                        let res = err.response
                        if (res.status == 422) {
                            this.error = res.data.error
                        }
                    })
                })
        },  
    },
}
</script>