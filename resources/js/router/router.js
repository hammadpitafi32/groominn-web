import { createRouter, createWebHistory } from "vue-router";
import Login from '../auth/Login.vue';
import Register from '../auth/Register.vue';
import AddShop from '../components/shop/AddShop.vue';
import Home from '../components/Index.vue';

const routes = [{
        path: '/',
        name: 'home',
        component: Home
    },
    {
        path: '/login',
        name: 'login',
        component: Login
    },
    {
        path: '/register',
        name: 'register',
        component: Register
    },
    {
        path: '/add-shop',
        name: 'addShop',
        component: AddShop
    }
]

export default createRouter({
    routes,
    history: createWebHistory()
})