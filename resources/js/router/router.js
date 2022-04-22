import { createRouter, createWebHistory } from "vue-router";
import Login from '../auth/Login.vue';
import Register from '../auth/Register.vue';
import AddShop from '../components/shop/AddShop.vue';
import MyShop from '../components/shop/MyShop.vue';
import MyCategories from '../components/provider/categories/MyCategories.vue';
import myServices from '../components/provider/services/MyServices.vue';
import Bookings from '../components/provider/bookings/Bookings.vue';
import BookingsList from '../components/client/booking/BookingsList.vue';
import Home from '../components/Index.vue';
import store from "../store";

const authentication = store.state.auth;

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
        },
    },
    {
        path: '/my-shop',
        name: 'myShop',
        component: MyShop,
        meta: {
            sidebar: true
        }
    },
    {
        path: '/shop-detail',
        name: 'shopDetail',
        component: MyShop,
        meta: {
            sidebar: false
        }
    },
    {
        path: '/my-categories',
        name: 'myCategories',
        component: MyCategories,
        meta: {
            sidebar: true
        }
    },
    {
        path: '/my-services',
        name: 'myServices',
        component: myServices,
        meta: {
            sidebar: true
        }
    },
    {
        path: '/bookings',
        name: 'bookings',
        component: Bookings,
        meta: {
            sidebar: true
        }
    },
    {
        path: '/booking-list',
        name: 'bookingList',
        component: BookingsList,
        meta: {
            sidebar: false
        }
    }
]

export default createRouter({
    routes,
    history: createWebHistory()
})