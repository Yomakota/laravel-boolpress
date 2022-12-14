import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import HomePage from './pages/HomePage.vue';
import Aboutpage from './pages/AboutPage.vue';
import BlogPage from './pages/BlogPage.vue';
import PageNotFound from './pages/PageNotFound.vue';
import Product from './pages/Product.vue';
import ContactPage from './pages/ContactPage.vue';

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
        },
        {
            path: '/blog/:slug',
            name: 'product',
            component: Product
        },
        {
            path: '/contact',
            name: 'contact',
            component: ContactPage
        },
        {
            path: '/*',
            name: 'not-found',
            component: PageNotFound
        }
    ]
});

export default router;