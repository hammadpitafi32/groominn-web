<template>
  <Header />
  <Sidebar v-if="route.meta.sidebar" />
  <main :class="route.meta.sidebar && 'pt-5 mt-5 mar-left'">
    <router-view />
  </main>
  <Footer v-if="route.name == 'home'" />
</template>

<script setup>
import Header from "./layout/Header.vue";
import Footer from "./layout/Footer.vue";

import { useRoute } from "vue-router";
import Sidebar from "./layout/Sidebar.vue";
import { useStore } from "vuex";

const route = useRoute();
const store = useStore();

store.dispatch('setAuth');

</script>

