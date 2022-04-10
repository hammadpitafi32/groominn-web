<template>
  <MDBNavbar
    classNavbar="shadow-0 main-navbar fixed-top"
    :class="route.name != 'home' && 'border-bottom'"
    ref="navbar"
    expand="md"
  >
    <MDBContainer>
      <MDBNavbarBrand>
        <router-link to="/"> <img src="../assets/img/logo.svg" alt="logo" class="img-fluid" /> </router-link>
      </MDBNavbarBrand>
      <MDBNavbarToggler target="navbarNav"></MDBNavbarToggler>
      <MDBNavbarNav collapse="navbarNav" right v-if="route.name != 'home'">
        <MDBNavbarItem to="/" class="me-3"> Home </MDBNavbarItem>
        <MDBNavbarItem to="#" class="me-3"> About </MDBNavbarItem>
        <MDBNavbarItem to="#" class="me-3"> Contact Us </MDBNavbarItem>
        <MDBNavbarItem to="#" class="me-3"> Support </MDBNavbarItem>
      </MDBNavbarNav>

      <MDBNavbarNav right v-else>
        <router-link to="/login" class="text-white">
        <MDBBtn
          color="dark"
          class="
            text-lowercase
            fw-bold
            fs-6
            rounded-4
            shadow-2-strong
            login-btn
          "
          size="sm"
          ripple
          >
          Login</MDBBtn
        >
        </router-link>
      </MDBNavbarNav>
    </MDBContainer>
  </MDBNavbar>
</template>

<script setup>
import { onMounted, ref } from "@vue/runtime-core";
import {
  MDBNavbar,
  MDBNavbarBrand,
  MDBNavbarToggler,
  MDBNavbarNav,
  MDBNavbarItem,
} from "mdb-vue-ui-kit";
import { useRoute } from "vue-router";

const navbar = ref(null);

const route = useRoute();

onMounted(() => {
  window.addEventListener("scroll", () => {
    if (window.scrollY > 10) {
      navbar.value.navbar.classList.add("bg-color-show");
    } else {
      navbar.value.navbar.classList.remove("bg-color-show");
    }
  });
});
</script>
