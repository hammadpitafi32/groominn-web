<template>
  <MDBContainer class="mt-5 py-5">
    <MDBRow center class="my-4">
      <MDBCol col="6">
        <PaymentDetail @sendData="sendData" :data="data" />
      </MDBCol>
      <MDBCol col="4">
        <PaymentMethod :data="data" />
      </MDBCol>
    </MDBRow>
  </MDBContainer>
</template>

<script setup>
import { ref, watchEffect } from "@vue/runtime-core";
import PaymentDetail from "./PaymentDetail.vue";
import PaymentMethod from "./PaymentMethod.vue";
import { useStore } from "vuex";
import { useRoute } from "vue-router";

const store = useStore();
const route = useRoute();
const itemsInCart = ref(null);
const data = ref({});

watchEffect(() => {
  store.dispatch("clientRedirection");
  store.dispatch("setAuth");
  if (route.params.data) {
    let jsondata = route.params.data.map((item) => JSON.parse(item));
    itemsInCart.value = jsondata;

    localStorage.setItem("item_in_cart", JSON.stringify(jsondata));
  } else {
    let items = localStorage.getItem("item_in_cart");
    itemsInCart.value = JSON.parse(items);
  }
});

const sendData = (val) => {
  data.value = { ...val, item_in_cart: itemsInCart.value };
};
</script>

