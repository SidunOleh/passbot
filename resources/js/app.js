import './bootstrap';
import { createApp } from 'vue'
import root from './vue/Root.vue'
import router from './router'
import Pagination from 'vue-laravel-paginex'

const app = createApp(root)
app.component('Pagination', Pagination)
app.use(router)
app.mount('#app')