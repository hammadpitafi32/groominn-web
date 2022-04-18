<template>
  <MDBContainer>
    <MDBRow class="mt-5 pt-4" v-if="!loading">
      <MDBCol col="5">
        <ShopPhotos :photos="apiResponse.data.user_business_images" />
      </MDBCol>
      <MDBCol col="7">
        <ShopDetails :data="apiResponse.data" />
      </MDBCol>
    </MDBRow>

    <Loader class="mt-5 pt-4" v-else />
  </MDBContainer>
</template>

<script setup>
import ShopPhotos from "./shop-detail-components/ShopPhotos.vue";
import ShopDetails from "./shop-detail-components/ShopDetails.vue";
import Loader from "../loaders/MyShopLoader.vue";
import { ref, watchEffect } from "@vue/runtime-core";
import { useStore } from "vuex";
import { useRouter } from "vue-router";
import { getUserBusiness } from "../../api";

const store = useStore();
const router = useRouter();
const loading = ref(true);
const apiResponse = ref(null);

watchEffect(() => {
  if (!store.state.auth) {
    router.push("/login");
  } else if (!store.state.shop) {
    router.push("/add-shop");
  }
});

if (store.state.myShop) {
  apiResponse.value = store.state.myShop;
  loading.value = false;
} else {
  getUserBusiness().then((res) => {
    apiResponse.value = res.data;
    store.state.myShop = res.data;
    loading.value = false;
  });
}
</script>

