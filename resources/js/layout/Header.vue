 <template>
  <MDBNavbar
    classNavbar="shadow-0 main-navbar fixed-top"
    :class="[
      route.name != 'home' && 'border-bottom',
      route.meta.sidebar || (store.state.auth && 'bg-white'),
    ]"
    ref="navbar"
    expand="md"
  >
    <MDBContainer>
      <MDBNavbarBrand>
        <router-link to="/">
          <img src="../assets/img/logo.svg" alt="logo" class="img-fluid" />
        </router-link>
      </MDBNavbarBrand>
      <MDBNavbarToggler target="navbarNav"></MDBNavbarToggler>
      <MDBNavbarNav
        collapse="navbarNav"
        class="align-items-center"
        right
        v-if="route.name != 'home' || store.state.auth"
      >
        <MDBNavbarItem
          to="/"
          class="me-4"
          :class="route.name == 'home' && 'navlink-active'"
        >
          {{ store.state.role === "Provider" ? "Dashboard" : "Home" }}
        </MDBNavbarItem>
        <MDBNavbarItem
          to="/about-us"
          class="me-4"
          :class="route.name == 'about-us' && 'navlink-active'"
        >
          About
        </MDBNavbarItem>
        <MDBNavbarItem
          to="/contact-us"
          class="me-4"
          :class="route.name == 'contact-us' && 'navlink-active'"
        >
          Contact Us
        </MDBNavbarItem>
        <MDBNavbarItem
          to="/booking-detail"
          class="me-4"
          :class="route.name == 'bookingDetail' && 'navlink-active'"
        >
          Bookings
        </MDBNavbarItem>
        <MDBNavbarItem to="#" class="me-4" v-if="!store.state.auth">
          Support
        </MDBNavbarItem>
        <MDBNavbarItem class="me-4 position-relative" v-if="store.state.auth">
          <span
            @click="notification = true"
            class="position-relative cursor-pointer"
          >
            <svg
              width="17"
              height="26"
              viewBox="0 0 23 32"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                fill-rule="evenodd"
                clip-rule="evenodd"
                d="M14.293 2.85241V3.26641C16.3577 3.88275 18.1684 5.14894 19.4558 6.87674C20.7433 8.60453 21.4388 10.7017 21.439 12.8564V22.8564H22.868V25.7154H0V22.8614H1.429V12.8614C1.42917 10.7067 2.12469 8.60953 3.41216 6.88174C4.69963 5.15394 6.5103 3.88775 8.575 3.27141V2.85241C8.58901 2.10354 8.89633 1.39008 9.43087 0.865441C9.96542 0.340798 10.6845 0.046875 11.4335 0.046875C12.1825 0.046875 12.9016 0.340798 13.4361 0.865441C13.9707 1.39008 14.278 2.10354 14.292 2.85241H14.293ZM4.293 22.8624H18.58V12.8624C18.58 10.967 17.8271 9.1493 16.4868 7.80907C15.1466 6.46884 13.3289 5.71591 11.4335 5.71591C9.53813 5.71591 7.72039 6.46884 6.38016 7.80907C5.03993 9.1493 4.287 10.967 4.287 12.8624L4.293 22.8624ZM14.293 28.5794V27.1494H8.576V28.5784C8.59001 29.3273 8.89733 30.0407 9.43187 30.5654C9.96642 31.09 10.6855 31.3839 11.4345 31.3839C12.1835 31.3839 12.9026 31.09 13.4371 30.5654C13.9717 30.0407 14.279 29.3273 14.293 28.5784V28.5794Z"
                fill="#8D8D8D"
              />
            </svg>
            <MDBBadge class="bg-orange text-white cus-pad" pill notification
              >5</MDBBadge
            >
          </span>
          <Notifications @close="closeNotification" v-if="notification" />
        </MDBNavbarItem>
        <MDBNavbarItem class="me-3" v-if="store.state.auth">
          <MDBDropdown v-model="profileDropdown" class="profile-dropdown">
            <MDBDropdownToggle
              class="bg-transparent shadow-0 text-dark p-0"
              @click="profileDropdown = !profileDropdown"
            >
              <img
                src="../assets/img/avatar.png"
                class="img-fluid avatar"
                alt=""
              />
              <span class="fw-bold mx-2 auth-name text-capitalize"
                >{{ store.state.name }}
                <em
                  class="fa-solid fa-angle-down text-orange ms-1"
                  :class="profileDropdown && 'rotate'"
                ></em
              ></span>
            </MDBDropdownToggle>
            <MDBDropdownMenu aria-labelledby="dropdownMenuButton" class="py-2">
              <MDBDropdownItem
                v-if="role === 'Client'"
                class="cursor-pointer"
                to="/profile"
                @click="profileDropdown = false"
                >Profile</MDBDropdownItem
              >
              <MDBDropdownItem href="javascript:void(0)" @click="logout()"
                >Logout</MDBDropdownItem
              >
            </MDBDropdownMenu>
          </MDBDropdown>
        </MDBNavbarItem>
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
import { onMounted, ref, watchEffect } from "@vue/runtime-core";
import { useStore } from "vuex";
import {
  MDBNavbar,
  MDBNavbarBrand,
  MDBNavbarToggler,
  MDBNavbarNav,
  MDBNavbarItem,
  MDBBadge,
  MDBDropdown,
  MDBDropdownToggle,
  MDBDropdownMenu,
  MDBDropdownItem,
} from "mdb-vue-ui-kit";
import { useRoute } from "vue-router";
import Notifications from "./Notifications.vue";
import { useCookies } from "vue3-cookies";

const navbar = ref(null);
const store = useStore();
const route = useRoute();
const role = ref("");
const { cookies } = useCookies();
const profileDropdown = ref(false);
const notification = ref(false);

onMounted(() => {
  window.addEventListener("scroll", () => {
    if (window.scrollY > 10) {
      navbar.value.navbar.classList.add("bg-color-show");
    } else {
      navbar.value.navbar.classList.remove("bg-color-show");
    }
  });
});

watchEffect(() => {
  role.value = store.state.role;
});

const closeNotification = () => {
  notification.value = false;
};

const logout = () => {
  profileDropdown.value = false;
  store.dispatch("setLogout");
};
</script>

<style scoped>
.cus-pad {
  padding: 0.19rem 0.3rem;
  margin-top: -0.2rem;
  margin-left: -0.4rem;
}
.avatar {
  max-width: 50px;
}
.auth-name {
  font-size: 0.95rem;
}
.fa-angle-down {
  transition: 0.27s ease;
}
.fa-angle-down.rotate {
  transform: rotate(180deg);
}
</style>
