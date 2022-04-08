import { createRouter, createWebHistory } from "vue-router";
import Login from '../auth/Login.vue';
import Register from '../auth/Register.vue';
import AddShop from '../components/shop/AddShop.vue';
import MyShop from '../components/shop/MyShop.vue';
import Home from '../components/Index.vue';

const routes = [{
        path: '/',
        name: 'home',
        component: Home,
        meta: {
            sidebar: false
        }
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
        meta: {
            sidebar: false
        }
    },
    {
        path: '/register',
        name: 'register',
        component: Register,
        meta: {
            sidebar: false
        }
    },
    {
        path: '/add-shop',
        name: 'addShop',
        component: AddShop,
        meta: {
            sidebar: true
        }
    },
    {
        path: '/shop-detail',
        name: 'myShop',
        component: MyShop,
        meta: {
            sidebar: true
        }
    }
]

export default createRouter({
    routes,
    history: createWebHistory()
})