import Vue from 'vue'
import VueRouter from 'vue-router'
import login from '../pages/login'
import register from '../pages/register'
import forum from '../pages/forum'
import read from '../pages/read'

Vue.use(VueRouter);

const routes = [
    {
        path: '/',
        redirect: '/forum'
    },
    {
        path: '/login', component: login
        , name: 'login',
        meta: {
            log: false
        }
    },
    {
        path: '/register', component: register
        , name: 'register',
        meta: {
            log: false
        }
    },
    {
        path: '/forum', component: forum
        , name: 'forum',
        meta: {
            log: true
        }
    },
    {
        path: '/read/:slug', component: read
        , name: 'read',
        meta: {
            log: true
        }
    },
]

const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
})

export default router;

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => !record.meta.log)) {
        // this route requires log, check if logged in
        // if not, redirect to login page.
        if (!User.isLoggedIn()) {
            next()
        } else {
            next(false)
        }
    } else {
        next()
    }
})
