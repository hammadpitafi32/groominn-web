<template>
    <aside class="sidebar">
        <ul class="list-unstyled side-menu">
            <li class="side-menu-item">
                <router-link :to="shop ? '/my-shop' : '/add-shop'">{{shop ? 'My Shop' : 'Add Shop'}}</router-link>
            </li>
            <li class="side-menu-item">
                <router-link to="/my-categories">My Categories</router-link>
            </li>
            <li class="side-menu-item">
                <router-link to="/my-services">My Services</router-link>
            </li>
            <li class="side-menu-item">
                <router-link to="/bookings">Bookings</router-link>
            </li>
            <li class="side-menu-item">
                <a href="javascript:void(0)" @click="store.dispatch('setLogout')">Logout</a>
            </li>
        </ul>
    </aside>
</template>

<script setup>
import { ref, watchEffect } from '@vue/runtime-core';
import { useStore } from 'vuex';

const store = useStore();
const shop = ref(false);

watchEffect(() => {
    shop.value = store.state.shop;
})

</script>