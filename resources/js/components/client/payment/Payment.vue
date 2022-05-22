<template>
  <MDBContainer class="mt-5 py-5">
    <MDBRow center class="my-4">
      <MDBCol col="6">
        <PaymentDetail />
      </MDBCol>
      <MDBCol col="4">
        <PaymentMethod />
      </MDBCol>
    </MDBRow>
  </MDBContainer>
</template>

<script setup>
import { watchEffect } from "@vue/runtime-core";
import PaymentDetail from "./PaymentDetail.vue";
import PaymentMethod from "./PaymentMethod.vue";
import { useStore } from 'vuex';

const store = useStore();

watchEffect(() => {
    store.dispatch('clientRedirection');
    store.dispatch('setAuth');
})
</script>

