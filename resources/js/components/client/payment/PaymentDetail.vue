<template>
  <div class="payment-detail">
    <h5 class="fw-bold mb-4">Payment Detail</h5>
    <form action="" class="payment-form mt-4">
      <div class="card-details mb-4">
        <label for="name" class="fw-500">Card Number</label>
        <small class="text-color-1 mb-3 d-block"
          >Enter the 16 digit card number on the card</small
        >
        <div class="number-field position-relative">
          <input
            type="tel"
            autocomplete="cc-number"
            maxlength="31"
            class="form-control card-number py-3"
            placeholder="xxxx  -  xxxx  -  xxxx  -  xxxx"
            v-model="cardNumber"
            :class="errors && errors.card_no && 'border-danger'"
          />
          <span class="card-image position-absolute">
            <svg
              width="48"
              height="32"
              viewBox="0 0 48 32"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <ellipse
                cx="32.1045"
                cy="16"
                rx="15.8467"
                ry="16"
                fill="#FFA51E"
              />
              <ellipse
                cx="16.7334"
                cy="16"
                rx="15.8467"
                ry="16"
                fill="#C90000"
                fill-opacity="0.73"
              />
            </svg>
          </span>
        </div>
        <small class="text-danger" v-if="errors && errors.card_no">{{
          errors.card_no[0]
        }}</small>
      </div>
      <div class="form-group mb-4">
        <label for="name" class="fw-500 mb-3">Card Holder Number</label>
        <input type="text" v-model="name" class="form-control py-3 fw-500" />
      </div>
      <div class="row mb-3 align-items-center">
        <div class="col-6">
          <label for="cvv-number" class="fw-500">CVV Number</label>
          <small class="fw-light d-block"
            >Enter the 3 or 4 digit number on the card</small
          >
        </div>
        <div class="col-6">
          <input
            type="text"
            v-model="cvv"
            maxlength="4"
            class="py-3 text-center fw-500 form-control"
            :class="errors && errors.cvc && 'border-danger'"
          />
          <small class="text-danger" v-if="errors && errors.cvc">{{
            errors.cvc[0]
          }}</small>
        </div>
      </div>
      <div class="row align-items-center mb-4">
        <div class="col-6">
          <label for="exp-date" class="fw-500">Expiry Date</label>
        </div>
        <div class="col-6">
          <div class="d-flex align-items-center">
            <input
              type="text"
              v-model="expMonth"
              maxlength="2"
              class="py-3 text-center fw-500 form-control"
            />
            <span class="mx-4">/</span>
            <input
              type="text"
              v-model="expYear"
              maxlength="2"
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
        :disabled="!itemsForBooking"
        @click="handlePayment()"
        >Pay Now</MDBBtn
      >
    </form>
  </div>
</template>

<script setup>
import { ref } from "@vue/reactivity";
import { computed, watch, watchEffect } from "@vue/runtime-core";
import { MDBInput } from "mdb-vue-ui-kit";
import { createBooking } from "../../../api";

const emit = defineEmits(["sendData"]);

const props = defineProps({
  data: Object,
});

const itemsForBooking = computed(() => props.data.item_in_cart);

const name = ref("");
const cvv = ref("");
const expMonth = ref("");
const expYear = ref("");
const cardNumber = ref("");
const cardNumberForRequest = ref("");
const errors = ref(null);

watch(cvv, (newValue, oldValue) => {
  let regix = /^[0-9]*$/;
  let test = regix.test(newValue);
  if (test) {
    cvv.value = newValue;
  } else {
    cvv.value = oldValue;
  }
});

watch(cardNumber, (newValue, oldValue) => {
  let test = /[a-zA-Z]/.test(newValue);

  if (test) {
    cardNumber.value = oldValue;
  } else {
    let matches = cardNumber.value
      .replace(/\s+/g, "")
      .replace(/[^0-9]/gi, "")
      .match(/\d{4,16}/g);
    var match = (matches && matches[0]) || "";
    var parts = [];

    for (let i = 0, len = match.length; i < len; i += 4) {
      parts.push(match.substring(i, i + 4));
    }
    if (parts.length) {
      cardNumber.value = parts.join("  -  ");
      cardNumberForRequest.value = parts.join("");
    } else {
      cardNumber.value = newValue;
      cardNumberForRequest.value = newValue;
    }
  }
});

watch(expMonth, (newValue, oldValue) => {
  let regix = /^[0-9]*$/;
  let test = regix.test(newValue);
  if (test) {
    expMonth.value = newValue;
    if (newValue > 12) {
      expMonth.value = "12";
    }
  } else {
    expMonth.value = oldValue;
  }
});

// Sending Data from this component to paymentMethod component
watchEffect(() => {
  emit("sendData", {
    name: name.value,
    card_number: cardNumberForRequest.value,
    exp_month: expMonth.value,
    exp_year: expYear.value,
  });

  // console.log(itemsForBooking.value);
});

watch(expYear, (newValue, oldValue) => {
  let regix = /^[0-9]*$/;
  let test = regix.test(newValue);
  if (test) {
    expYear.value = newValue;
  } else {
    expYear.value = oldValue;
  }
});

// Payment function
const handlePayment = () => {
  const formData = new FormData();
  formData.append("card_no", cardNumberForRequest.value);
  formData.append("exp_month", expMonth.value);
  formData.append("exp_year", expYear.value);
  formData.append("cvc", cvv.value);
  formData.append("user_business_id", props.data.business_id);
  formData.append("charges", props.data.charges);
  formData.append("date", props.data.booking_date);

  createBooking(formData)
    .then((response) => {
      console.log(response);
    })
    .catch((error) => {
      errors.value = error.response.data.errors;
      console.log(errors.value);
    });
};
</script>

<style scoped>
input.card-number {
  padding-left: 90px;
}
.card-image {
  top: calc(50% - 16px);
  left: 15px;
}
</style>