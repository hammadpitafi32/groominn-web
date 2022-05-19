<template>
  <div v-if="!loading">
    <MDBContainer
      v-if="apiResponse && apiResponse.data"
      :class="route.name == 'shopDetail' && 'mt-5 pt-4'"
    >
      <MDBRow class="mt-5 pt-4">
        <MDBCol col="5">
          <ShopPhotos :photos="apiResponse.data.user_business_images" />
        </MDBCol>
        <MDBCol col="7">
          <ShopDetails :data="apiResponse.data" />
        </MDBCol>
      </MDBRow>
    </MDBContainer>
  </div>
  <MDBContainer v-else>
    <MDBRow :class="route.name == 'shopDetail' && 'mt-5 pt-4'">
      <Loader class="mt-5 pt-4" />
    </MDBRow>
  </MDBContainer>
</template>

<script setup>
import ShopPhotos from "./shop-detail-components/ShopPhotos.vue";
import ShopDetails from "./shop-detail-components/ShopDetails.vue";
import Loader from "../loaders/MyShopLoader.vue";
import { ref, watchEffect } from "@vue/runtime-core";
import { useStore } from "vuex";
import { useRouter, useRoute } from "vue-router";
import { getUserBusiness } from "../../api";
import { useCookies } from "vue3-cookies";

const store = useStore();
const router = useRouter();
const route = useRoute();
const { cookies } = useCookies();
const loading = ref(true);
const apiResponse = ref(null);

const getProviderBusiness = () => {
  getUserBusiness().then((res) => {
    apiResponse.value = res.data;
    loading.value = false;
    if (!res.data.data) {
      let user = cookies.get("user");
      user.is_shop = false;
      cookies.set("user", user);
      store.dispatch("setAuth");
    }
  });
};

const getShopForClient = () => {
  if (route.params.id) {
    getUserBusiness(route.params.id).then(({ data }) => {
      apiResponse.value = data;
      loading.value = false;
    });
  }
};

watchEffect(() => {
  if (store.state.auth) {
    if (store.state.role === "Provider" && !store.state.shop) {
      router.push("/add-shop");
    } else if (
      store.state.role === "Provider" &&
      store.state.shop &&
      route.name === "myShop"
    ) {
      getProviderBusiness();
    } else if (store.state.role === "Provider" && route.name === "shopDetail") {
      router.push("/my-shop");
    } else if (store.state.role === "Client" && (route.name === "myShop" || route.name === "addShop")) {
      router.push("/");
    } else if (store.state.role === "Client" && route.name == "shopDetail") {
      getShopForClient();
    }
  } else {
    router.push("/login");
  }
});
</script>

