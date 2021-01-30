import Vue from 'vue'
import VueRouter from 'vue-router'
import login from '../pages/login'
import register from '../pages/register'
import forum from '../pages/forum'
import read from '../pages/read'
import create from '../pages/create'
import notification from "../pages/notification";

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
            log: true,
            auth: false
        }
    },
    {
        path: '/register', component: register
        , name: 'register',
        meta: {
            log: true,
            auth: false
        }
    },
    {
        path: '/forum', component: forum
        , name: 'forum',
        meta: {
            log: false,
            auth: false
        }
    },
    {
        path: '/read/:slug', component: read
        , name: 'read',
        meta: {
            log: false,
            auth: false
        }
    },
    {
        path: '/question/create', component: create,
        name: 'question-create',
        meta: {
            log: false,
            auth: true
        }
    },
    {
        path: '/notification', component: notification,
        name: 'notification',
        meta: {
            log: false,
            auth: true
        }
    }
]

const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
})

export default router;

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.log)) {
        // this route requires log, check if  authentication route
        // if not, next.
        if (!User.isLoggedIn()) {
            next()
        } else {
            next(false)
        }
    } else if (to.matched.some(record => record.meta.auth)) {
        // this route requires auth, check if  authenticate
        // if not, redirect to login.
        if (User.isLoggedIn()) {
            next()
        } else {
            next({name: 'login'})
        }
    } else {
        return next()
    }
})
