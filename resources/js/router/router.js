import Vue from 'vue'
import VueRouter from 'vue-router'
import test from '../components/test'

Vue.use(VueRouter)

const routes = [
    {path: '/test', component: test},
]

const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
})

export default router;
