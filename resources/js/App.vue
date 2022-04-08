<template>
  <Header />
  <Sidebar v-if="route.name !== 'home' && route.name !== 'login' && route.name !== 'register'" />
  <router-view :class="route.name !== 'home' && route.name !== 'login' && route.name !== 'register' && 'pt-5 mt-5 mar-left'" />
  <Footer v-if="route.name == 'home'" />
</template>

<script setup>
import Header from "./layout/Header.vue";
import Footer from "./layout/Footer.vue";

import { useRoute } from "vue-router";
import Sidebar from "./layout/Sidebar.vue";

const route = useRoute();
</script>

