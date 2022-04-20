<template>
  <div v-if="!loading">
    <MDBContainer v-if="apiResponse && apiResponse.data">
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
    <MDBRow>
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
import { useRouter } from "vue-router";
import { getUserBusiness } from "../../api";
import { useCookies } from "vue3-cookies";

const store = useStore();
const router = useRouter();
const { cookies } = useCookies();
const loading = ref(true);
const apiResponse = ref(null);

watchEffect(() => {
  if (!store.state.auth) {
    router.push("/login");
  } else if (store.state.role == 'Provider' && !store.state.shop) {
    router.push("/add-shop");
  } else if(store.state.role == 'Client'){
    router.push('/');
  }
});

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
</script>

