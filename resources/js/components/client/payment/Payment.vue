<template>
  <MDBContainer class="mt-5 py-5">
    <MDBRow center class="my-4">
      <MDBCol col="6">
        <PaymentDetail @sendData="sendData" :data="data" />
      </MDBCol>
      <MDBCol col="4">
        <PaymentMethod @sendCharges="sendCharges" :data="data" />
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
const business_id = ref(null);
const data = ref({});

watchEffect(() => {
  store.dispatch("clientRedirection");
  store.dispatch("setAuth");
  if (route.params.data) {
    let dataForPayment = JSON.parse(route.params.data);
    let jsondata = dataForPayment.items.map((item) => JSON.parse(item));
    itemsInCart.value = jsondata;

    localStorage.setItem(
      "data",
      JSON.stringify({
        items: JSON.stringify(jsondata),
        id: dataForPayment.user_business_id,
        date: dataForPayment.booking_date,
      })
    );
  } else {
    let items = localStorage.getItem("data");
    itemsInCart.value = JSON.parse(items).items;
  }
});

const sendData = (val) => {
  data.value = {
    ...val,
    item_in_cart: itemsInCart.value,
    business_id: business_id.value,
  };
};

const sendCharges = (val) => {
  data.value = { ...data.value, charges: val };
};
</script>

