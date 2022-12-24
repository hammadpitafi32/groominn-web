<template>
    <aside class="sidebar gradiant-list">
        <ul  class="list-unstyled side-menu">
            <li class="side-menu-item">
                <router-link class="nav-link" :to="shop ? '/my-shop' : '/add-shop'"><i class="fa-solid fa-shop"></i> {{
                    shop ? "My Shop" : "Add Shop"
                }}</router-link>
            </li>
           
            <li class="side-menu-item" v-if="shop">
                <router-link to="/my-categories" class="nav-link"><i class="fa-solid fa-chair"></i> My Categories</router-link>
            </li>
            <li class="side-menu-item" v-if="shop">
                <router-link to="/my-services" class="nav-link"><i class="fa-solid fa-bell-concierge"></i> My Services</router-link>
            </li>
         <!--    <li class="side-menu-item" v-if="shop">
                <router-link to="/bank-details" class="nav-link"><i class="fa-solid fa-piggy-bank"></i> Bank Details</router-link>
            </li> -->
            <li class="side-menu-item" v-if="shop">
                <router-link to="/bookings" class="nav-link"><i class="fa fa-book nav-icon blue"></i> Bookings</router-link>
            </li>
<!--             <li class="side-menu-item" v-if="shop">
                <router-link to="/my-earnings" class="nav-link"><i class="fa fa-money-bill nav-icon"></i> My Earnings</router-link>
            </li> -->
            <li class="side-menu-item">
                <a class="nav-link" 
                    href="javascript:void(0)"
                    @click="store.dispatch('setLogout')"
                    ><i class="nav-icon fas fa-power-off red"></i> Logout</a
                >
            </li>
        </ul>
    </aside>
</template>

<script setup>
import { ref, watchEffect } from "@vue/runtime-core";
import { useStore } from "vuex";
import { useRoute } from "vue-router";

const store = useStore();
const shop = ref(false);
const route = useRoute();

watchEffect(() => {
    shop.value = store.state.shop;
});
</script>

<style scoped>
.side-menu-item a.disable {
    pointer-events: none;
    opacity: 0.5;
}
</style>
