<template>
    <section class="site">
        <div class="container">
            <div class="site__body">
                <div class="site__edit">
                    <form @submit.prevent="editSite" class="w-50">
                        <div v-if="message" class="error alert alert-success">
                            {{ message }}
                        </div>
                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <div v-if="hasError('name')" class="error alert alert-danger">
                                {{ errors.name[0] }}
                            </div>
                            <input v-model="site.name" type="text" class="form-control" id="name" placeholder="Enter site name">
                        </div> 
                        <div class="form-group mb-3">
                            <label for="url">Url</label>
                            <div v-if="hasError('url')" class="error alert alert-danger">
                                {{ errors.url[0] }}
                            </div>
                            <input v-model="site.url" type="text" class="form-control" id="url" placeholder="Enter site url">
                        </div>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </form>
                </div>
                <div class="site__credentials pt-4">
                    <div class="site__add-credentials">
                        <router-link :to="{name: 'credential.create'}" class="btn btn-primary mt-3 mb-3">Add new credential</router-link>
                    </div>
                    <div v-for="credential in site.credentials" class="credentials__item bg-light mt-2 mb-2 p-3">
                        <p class="h5 mb-4">{{ credential.name }}</p>
                        <p v-for="item of credential.credentials">
                            {{ item }}
                        </p>
                        <a @click.prevent="deleteCredential(credential.id)" href="/" class="btn btn-danger">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            site: {},
            errors: {},
            message: '',
        }
    },
    methods: {
        getSite() {
            axios.get(`/api/sites/${this.$route.params.id}`)
                .then(res => {
                    this.site = res.data.site
                })
        },
        editSite() {
            axios.patch(`/api/sites/${this.$route.params.id}`, {
                name: this.site.name,
                url: this.site.url,
            }).then(res => {
                this.errors = {}
                this.message = res.data.message
            }).catch(err => {
                this.errors = err.response.data.errors
                this.message = ''
            })
        },  
        deleteCredential(id) {
            if (! confirm('Are you sure?')) {
                return
            }

            axios.delete(`/api/sites/${this.$route.params.id}/credentials/${id}`)
                .then(res => {
                    this.getSite()
                })
        },
        hasError(field) {
            return this.errors.hasOwnProperty(field)
        },  
    },
    mounted() {
        this.getSite()
    },
}
</script>

<style>
@media (max-width: 1054px) {
    .site form {
        width: 100% !important;
    }
}
</style>