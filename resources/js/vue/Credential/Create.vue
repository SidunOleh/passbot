<template>
    <section class="credential-add">
        <div class="container">
            <div class="credential-add__body">
                <form @submit.prevent="createCredential" class="w-50">
                    <div class="form-group mb-3">
                        <label for="name">Name</label>
                        <div v-if="hasError('name')" class="error alert alert-danger">
                            {{ errors.name[0] }}
                        </div>
                        <input v-model="name" type="text" class="form-control" id="name" placeholder="Enter credential name">
                    </div>
                    <div class="form-group mb-3">
                        <label for="value">Values</label>
                        <div v-if="hasError('credentials')" class="error alert alert-danger">
                            {{ 'Credentials are wrong' }}
                        </div>
                        <template v-for="credential, index of credentials">
                            <div v-if="hasError(`credentials.${index}`)" class="error alert alert-danger">
                                {{ 'Credential is invalid' }}
                            </div>
                            <input v-model="credentials[index]" type="text" class="cred-input form-control mb-2" id="value" placeholder="Enter credential value">
                        </template>
                        <a @click.prevent="addField" href="/" class="text-decoration-none">+ field</a>
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
            credentials: ['', '',],
            errors: {},
        }
    },
    methods: {
        createCredential() {
            axios.post(`/api/sites/${this.$route.params.id}/credentials`, {
                name: this.name,
                credentials: this.credentials,
            }).then(res => {
                router.push({name: 'sites.show', params: {id: this.$route.params.id}})
            }).catch(err => {
                this.errors = err.response.data.errors
            })
        },
        addField() {
            this.credentials.push('')
        },
        hasError(field) {
            return this.errors.hasOwnProperty(field)
        },
    }
}
</script>

<style>
@media (max-width: 1054px) {
    .credential-add form {
        width: 100% !important;
    }
}
</style>