<template>
  <div class="payment-detail">
    <h5 class="fw-bold mb-4">Payment Detail</h5>
    <div class="card-details">
      <span class="d-block fw-500">Card Number</span>
      <small class="text-color-1"
        >Enter the 16 digit card number on the card</small
      >
    </div>
    <form action="" class="payment-form mt-4">
      <div class="form-group mb-4">
        <label for="name" class="small fw-500 mb-3">Card Holder Number</label>
        <MDBInput type="text" v-model="name" class="py-3 fw-500" />
      </div>
      <div class="row mb-3 align-items-center">
        <div class="col-6">
          <label for="cvv-number" class="small fw-500">CVV Number</label>
          <small class="fw-light d-block"
            >Enter the 3 or 4 digit number on the card</small
          >
        </div>
        <div class="col-6">
          <input
            type="text"
            v-model="cvv"
            class="py-3 text-center fw-500 form-control"
          />
        </div>
      </div>
      <div class="row align-items-center mb-4">
        <div class="col-6">
          <label for="exp-date" class="small fw-500">Expiry Date</label>
        </div>
        <div class="col-6">
          <div class="d-flex align-items-center">
            <input
              type="text"
              v-model="expMonth"
              class="py-3 text-center fw-500 form-control"
            />
            <span class="mx-4">/</span>
            <input
              type="text"
              v-model="expYear"
              class="py-3 text-center fw-500 form-control"
            />
          </div>
        </div>
      </div>
      <MDBBtn
        class="
          bg-orange
          text-white
          fw-500
          shadow-0
          w-100
          mt-2
          py-3
          rounded-4
          text-capitalize
          fs-6
        "
        >Pay Now</MDBBtn
      >
    </form>
  </div>
</template>

<script setup>
import { ref } from "@vue/reactivity";
import { watch } from "@vue/runtime-core";
import { MDBInput } from "mdb-vue-ui-kit";

const name = ref("");
const cvv = ref("");
const expMonth = ref("");
const expYear = ref("");

watch(cvv, (newValue, oldValue) => {
    let regix = /^[0-9]*$/;
    let test = regix.test(newValue);
    if(test){
        cvv.value = newValue;
        if(newValue.length > 4){
            cvv.value = oldValue
        }
    } else {
        cvv.value = oldValue
    }
});

watch(expMonth, (newValue, oldValue) => {
    let regix = /^[0-9]*$/;
    let test = regix.test(newValue);
    if(test){
        expMonth.value = newValue;
        if(newValue.length > 2){
            expMonth.value = oldValue
        }
        if(newValue > 12){
            expMonth.value = "12"
        }
    } else {
        expMonth.value = oldValue
    }
});

watch(expYear, (newValue, oldValue) => {
    let regix = /^[0-9]*$/;
    let test = regix.test(newValue);
    if(test){
        expYear.value = newValue;
        if(newValue.length > 4){
            expYear.value = oldValue
        }
    } else {
        expYear.value = oldValue
    }
});
</script>
