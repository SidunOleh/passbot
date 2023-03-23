<template>
    <section class="add-site">
        <div class="container">
            <div class="add-site__body">
                <form @submit.prevent="createSite" class="w-50">
                    <div class="form-group mb-3">
                        <label for="name">Name</label>
                        <div v-if="hasError('name')" class="error alert alert-danger">
                            {{ errors.name[0] }}
                        </div>
                        <input v-model="name" type="text" class="form-control" id="name" placeholder="Enter site name">
                    </div> 
                    <div class="form-group mb-3">
                        <label for="url">Url</label>
                        <div v-if="hasError('url')" class="error alert alert-danger">
                            {{ errors.url[0] }}
                        </div>
                        <input v-model="url" type="text" class="form-control" id="url" placeholder="Enter site url">
                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>
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
            name: '',
            url: '',
            errors: {},
        }
    },
    methods: {
        createSite() {
            axios.post('/api/sites', {
                name: this.name,
                url: this.url,
            }).then(res => {
                router.push({name: 'sites.show', params: {id: res.data.site.id}})
            }).catch(err => {
                let res = err.response
                if (res.status == 422) {
                    this.errors = res.data.errors
                }
            })
        },
        hasError(field) {
            return this.errors.hasOwnProperty(field)
        },  
    }
}
</script>

<style>
@media (max-width: 1024px) {
    .add-site form {
        width: 100% !important;
    }
}
</style>