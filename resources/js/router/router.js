import Vue from 'vue'
import VueRouter from 'vue-router'
import login from '../pages/login'
import register from '../pages/register'
import forum from '../pages/forum'

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
            auth: false
        }
    },
    {
        path: '/register', component: register
        , name: 'register',
        meta: {
            auth: false
        }
    },
    {
        path: '/forum', component: forum
        , name: 'forum',
        meta: {
            auth: true
        }
    },
]

const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
})

export default router;

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => !record.meta.auth)) {
        // this route requires auth, check if logged in
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
