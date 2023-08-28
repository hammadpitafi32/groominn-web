import { createRouter, createWebHistory } from "vue-router";
import Login from "../auth/Login.vue";
import Register from "../auth/Register.vue";
import AddShop from "../components/shop/AddShop.vue";
import MyShop from "../components/shop/MyShop.vue";
import MyCategories from "../components/provider/categories/MyCategories.vue";
import myServices from "../components/provider/services/MyServices.vue";
import Bookings from "../components/provider/bookings/Bookings.vue";
import BookingsList from "../components/client/booking/BookingsList.vue";
import Profile from "../components/client/profile/Profile.vue";
import bookingDetail from "../components/client/booking/BookingDetail.vue";
import MyEarnings from "../components/provider/earnings/MyEarnings.vue";
import BankDetails from "../components/provider/bank-details/BankDetails.vue";
import Payment from "../components/client/payment/Payment.vue";
import NotFound from "../components/custom-components/NotFound.vue";
import Home from "../components/Index.vue";
import AboutUs from "../components/AboutUs.vue";
import ContactUs from "../components/ContactUs.vue";
import store from "../store";
import MyShopHours from "../components/provider/business-hours/BusinessHours.vue";
import termsPolicy from "../components/Terms&Policy.vue";
import support from "../components/Support.vue";

const routes = [
    {
        path: "/",
        name: "home",
        component: Home,
        meta: {
            sidebar: false,
            auth: false,
        },
    },
    {
        path: "/about-us",
        name: "about-us",
        component: AboutUs,
        meta: {
            sidebar: false,
            auth: false,
        },
    },
    {
        path: "/terms-policy",
        name: "terms-policy",
        component: termsPolicy,
        meta: {
            sidebar: false,
            auth: false,
        },
    },
    {
        path: "/support",
        name: "support",
        component: support,
        meta: {
            sidebar: false,
            auth: false,
        },
    },
    {
        path: "/contact-us",
        name: "contact-us",
        component: ContactUs,
        meta: {
            sidebar: false,
            auth: false,
        },
    },
    {
        path: "/profile",
        name: "profile",
        component: Profile,
        meta: {
            sidebar: false,
            auth: true,
        },
    },
    {
        path: "/login",
        name: "login",
        component: Login,
        meta: {
            sidebar: false,
            auth: false,
        },
    },
    {
        path: "/register",
        name: "register",
        component: Register,
        meta: {
            sidebar: false,
            auth: false,
        },
    },
    {
        path: "/add-shop",
        name: "addShop",
        component: AddShop,
        meta: {
            sidebar: true,
            auth: true,
        },
    },
    {
        path: "/edit-shop/:id",
        name: "editShop",
        component: AddShop,
        meta: {
            sidebar: true,
            auth: true,
        },
    },
    {
        path: "/my-shop",
        name: "myShop",
        component: MyShop,
        meta: {
            sidebar: true,
            auth: true,
        },
    },
    {
        path: "/my-shop-hours",
        name: "myShopHours",
        component: MyShopHours,
        meta: {
            sidebar: true,
            auth: true,
        },
    },
    {
        path: "/shop-detail/:id",
        name: "shopDetail",
        component: MyShop,
        meta: {
            sidebar: false,
            auth: true,
        },
    },
    {
        path: "/my-categories",
        name: "myCategories",
        component: MyCategories,
        meta: {
            sidebar: true,
            auth: true,
        },
    },
    {
        path: "/my-services",
        name: "myServices",
        component: myServices,
        meta: {
            sidebar: true,
            auth: true,
        },
    },
    {
        path: "/bookings",
        name: "bookings",
        component: Bookings,
        meta: {
            sidebar: true,
            auth: true,
        },
    },
    {
        path: "/booking-list",
        name: "bookingList",
        component: BookingsList,
        meta: {
            sidebar: false,
            auth: true,
        },
    },
    {
        path: "/my-earnings",
        name: "myEarnings",
        component: MyEarnings,
        meta: {
            sidebar: true,
            auth: true,
        },
    },
    {
        path: "/bank-details",
        name: "bankDetails",
        component: BankDetails,
        meta: {
            sidebar: true,
            auth: true,
        },
    },
    {
        path: "/booking-detail",
        name: "bookingDetail",
        component: bookingDetail,
        meta: {
            sidebar: false,
            auth: true,
        },
    },
    {
        path: "/checkin",
        name: "checkin",
        component: Payment,
        meta: {
            sidebar: false,
            auth: true,
        },
    },
    { path: "/:pathMatch(.*)*", name: "NotFound", component: NotFound },
];

const router = createRouter({
    routes,
    history: createWebHistory(),
});

router.beforeEach(async (to, from, next) => {
    if (!store.state.auth && to.meta.auth) {
        next("/login");
    } else {
        next();
    }
});

export default router;
