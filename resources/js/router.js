import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import HomePage from './pages/HomePage.vue';
import Aboutpage from './pages/AboutPage.vue';
import BlogPage from './pages/BlogPage.vue';

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: HomePage
        },
        {
            path: '/about',
            name: 'about',
            component: Aboutpage
        },
        {
            path: '/blog',
            name: 'blog',
            component: BlogPage
        }
    ]
});

export default router;