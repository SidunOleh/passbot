<template>
    <section class="sites">
        <div class="container">
            <div class="sites__body">
                <div class="sites__add">
                    <router-link :to="{name: 'sites.create'}" class="btn btn-primary">Add new site</router-link>
                </div>
                <div class="sites__table pt-3 overflow-auto">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Url</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody v-for="site, key in sites.data">
                            <tr>
                                <th scope="row">{{ key + 1 }}</th>
                                <td>
                                    <router-link :to="{ name: 'sites.show', params: {id: site.id} }" class="text-decoration-none">
                                        {{ site.name }}
                                    </router-link>
                                </td>
                                <td><a :href="site.url">{{ site.url }}</a></td>
                                <td><a @click.prevent="deleteSite(site.id)" href="/" title="Delete" class="text-decoration-none">❌</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <Pagination v-if="sites.hasOwnProperty('current_page') && sites.last_page != 1" :changePage="getSites" :data="sites"/>
            </div>
        </div>
    </section>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            sites: {},
        }
    },
    methods: {
        getSites(pag={page: 1}) {
            axios.get(`/api/sites?page=${pag.page}`)
                .then(res => {
                    this.sites = res.data.sites
                })
        },
        deleteSite(id) {
            if (! confirm('Are you sure?')) {
                return
            }

            axios.delete(`/api/sites/${id}`)
                .then(res => {
                    this.getSites()
                })
        },
    },
    mounted() {
        this.getSites()
    }
}
</script>