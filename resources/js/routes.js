import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: '/',
        name: 'dashboard',
        component: () => import('./pages/Dashboard.vue'),
    },
    {
        path: '/login',
        name: 'login',
        component: () => import('./pages/Login.vue'),
    },
    {
        path: '/brand',
        name: 'brand',
        component: () => import('./pages/Brand.vue'),
    },
    {
        path: '/category',
        name: 'category',
        component: () => import('./pages/Category.vue'),
    },
    {
        path: '/supplier',
        name: 'supplier',
        component: () => import('./pages/Supplier.vue'),
    },
    {
        path: '/product',
        name: 'product',
        component: () => import('./pages/Product.vue'),
    },
    {
        path: '/:pathMatch(.*)*', name:'notfound',component:() => import('./pages/NotFound.vue')
    }
];

export default createRouter({
    history: createWebHistory('/'),
    routes,
    linkActiveClass:"active",
    linkExactActiveClass:"exact-active"
});