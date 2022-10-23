<template>
    <Header />
    <Sidebar v-if="route.meta.sidebar" />
    <main :class="route.meta.sidebar && 'pt-5 mt-5 mar-left'">
        <router-view />
    </main>
    <Footer v-if="route.name == 'home' || store.state.role == 'Client'" />
</template>

<script setup>
import Header from "./layout/Header.vue";
import Footer from "./layout/Footer.vue";

import { useRoute } from "vue-router";
import Sidebar from "./layout/Sidebar.vue";
import { useStore } from "vuex";
import { onUpdated, watchEffect } from "@vue/runtime-core";

const route = useRoute();
const store = useStore();

store.dispatch("setAuth");

watchEffect(() => {
    if (
        (route.name == "home" || route.name == "bookingList") &&
        !store.state.allCategories
    ) {
        store.dispatch("getCategories");
    }
});
</script>
