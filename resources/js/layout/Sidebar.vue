<template>
    <aside class="sidebar">
        <ul class="list-unstyled side-menu">
            <li class="side-menu-item">
                <router-link :to="shop ? '/my-shop' : '/add-shop'">{{shop ? 'My Shop' : 'Add Shop'}}</router-link>
            </li>
            <li class="side-menu-item">
                <router-link to="/my-categories" :class="!shop && 'disable'">My Categories</router-link>
            </li>
            <li class="side-menu-item">
                <router-link to="/my-services" :class="!shop && 'disable'">My Services</router-link>
            </li>
            <li class="side-menu-item">
                <router-link to="/bookings" :class="!shop && 'disable'">Bookings</router-link>
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
import { useRoute } from 'vue-router';

const store = useStore();
const shop = ref(false);
const route = useRoute();

watchEffect(() => {
    shop.value = store.state.shop;
})

</script>

<style scoped>

.side-menu-item a.disable{
    pointer-events: none;
    opacity: .5;
}

</style>