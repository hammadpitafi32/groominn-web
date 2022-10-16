import { createRouter, createWebHistory } from "vue-router";
import Login from '../auth/Login.vue';
import Register from '../auth/Register.vue';
import AddShop from '../components/shop/AddShop.vue';
import MyShop from '../components/shop/MyShop.vue';
import MyCategories from '../components/provider/categories/MyCategories.vue';
import myServices from '../components/provider/services/MyServices.vue';
import Bookings from '../components/provider/bookings/Bookings.vue';
import BookingsList from '../components/client/booking/BookingsList.vue';
import Profile from '../components/client/profile/Profile.vue';
import bookingDetail from '../components/client/booking/BookingDetail.vue';
import Payment from '../components/client/payment/Payment.vue';
import NotFound from '../components/custom-components/NotFound.vue'
import Home from '../components/Index.vue';
import AboutUs from '../components/AboutUs.vue';
import ContactUs from '../components/ContactUs.vue';
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
    path: '/about-us',
    name: 'about-us',
    component: AboutUs,
    meta: {
        sidebar: false
    }
},
{
    path: '/contact-us',
    name: 'contact-us',
    component: ContactUs,
    meta: {
        sidebar: false
    }
},
{
    path: '/profile',
    name: 'profile',
    component: Profile,
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
    path: '/edit-shop/:id',
    name: 'editShop',
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
    path: '/shop-detail/:id',
    name: 'shopDetail',
    component: MyShop,
    meta: {
        sidebar: false
    },
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
},
{
    path: '/booking-detail',
    name: 'bookingDetail',
    component: bookingDetail,
    meta: {
        sidebar: false
    }
},
{
    path: '/payment',
    name: 'payment',
    component: Payment,
    meta: {
        sidebar: false
    }
},
{ path: '/:pathMatch(.*)*', name: 'NotFound', component: NotFound },
]

export default createRouter({
    routes,
    history: createWebHistory()
})