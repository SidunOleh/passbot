import { createRouter, createWebHistory } from 'vue-router'

const routes = [{
        path: '/login',
        component: () =>
            import ('./vue/Auth/Login.vue'),
        name: 'auth.login',
    },
    {
        path: '/',
        component: () =>
            import ('./vue/Sites/Index.vue'),
        name: 'sites.index',
    },
    {
        path: '/sites/create',
        component: () =>
            import ('./vue/Sites/Create.vue'),
        name: 'sites.create',
    },
    {
        path: '/sites/:id',
        component: () =>
            import ('./vue/Sites/Show.vue'),
        name: 'sites.show',
    },
    {
        path: '/sites/:id/credential',
        component: () =>
            import ('./vue/Credential/Create.vue'),
        name: 'credential.create',
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

router.beforeEach((to, from, next) => {
    if (to.name != 'auth.login' && !localStorage.getItem('auth')) {
        return next({ name: 'auth.login' })
    }

    return next()
})

export default router