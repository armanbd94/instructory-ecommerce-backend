import { createRouter, createWebHistory } from "vue-router";
import AdminLayout from './pages/Index';
const routes = [
    
    {
        path: '/login',
        name: 'login',
        component: () => import('./pages/Login.vue'),
        meta: {
            requireAuth: false
        }
    },
    {
        path: '/',
        name: 'dashboard',
        component: () => import('./pages/Dashboard.vue'),
        meta: {
            requireAuth: true,
            layout: AdminLayout
        }
    },
    {
        path: '/brand',
        name: 'brand',
        component: () => import('./pages/Brand.vue'),
        meta: {
            requireAuth: true,
            layout: AdminLayout
        }
    },
    {
        path: '/category',
        name: 'category',
        component: () => import('./pages/Category.vue'),
        meta: {
            requireAuth: true,
            layout: AdminLayout
        }
    },
    {
        path: '/supplier',
        name: 'supplier',
        component: () => import('./pages/Supplier.vue'),
        meta: {
            requireAuth: true,
            layout: AdminLayout
        }
    },
    {
        path: '/product',
        name: 'product',
        component: () => import('./pages/Product.vue'),
        meta: {
            requireAuth: true,
            layout: AdminLayout
        }
    },
    {
        path: '/profile',
        name: 'profile',
        component: () => import('./pages/Profile.vue'),
        meta: {
            requireAuth: true,
            layout: AdminLayout
        }
    },
    {
        path: '/:pathMatch(.*)*',
        // path: "/:catchAll(.*)", 
        name:'notfound',
        component:() => import('./pages/NotFound.vue'),
        meta: {
            requireAuth: false
        }
    }
];

const router = createRouter({
    history: createWebHistory('/'),
    routes,
    linkActiveClass:"active",
    linkExactActiveClass:"exact-active"
});

router.beforeEach((to,from) => {
    // if (to.matched.some(record => record.meta.requireAuth)) {
    //     if (localStorage.getItem('token')) {
    //         next();
    //         return;
    //     }
    //     next("/login");
    // } else {
    //     next();
    // }
    if(to.meta.requireAuth && !localStorage.getItem('token'))
    {
        return { name: 'login' }
    }
    if(to.meta.requireAuth == false && localStorage.getItem('token'))
    {
        return { name: 'dashboard' }
    }
})

export default router;