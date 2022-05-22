<template>
  <div class="payment-detail ps-4">
    <h5>Choose payment method</h5>
    <div class="d-flex payment-methods mt-1">
      <label
        class="cursor-pointer me-5"
        :class="paymentMethod === 'master' && 'active'"
      >
        <svg
          width="40"
          height="24"
          viewBox="0 0 48 32"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <ellipse cx="32.1045" cy="16" rx="15.8467" ry="16" fill="#FFA51E" />
          <ellipse
            cx="16.7334"
            cy="16"
            rx="15.8467"
            ry="16"
            fill="#C90000"
            fill-opacity="0.73"
          />
        </svg>
        <MDBRadio
          type="radio"
          :btnCheck="true"
          name="method"
          value="master"
          v-model="paymentMethod"
          class="custom-check-input"
        />
      </label>
      <label
        class="cursor-pointer me-5"
        :class="paymentMethod === 'easypaisa' && 'active'"
      >
        <img
          src="../../../../../public/images/easypaisa.png"
          class="img-fluid"
          alt=""
        />
        <MDBRadio
          type="radio"
          :btnCheck="true"
          name="method"
          value="easypaisa"
          v-model="paymentMethod"
          class="custom-check-input"
        />
      </label>
      <label
        class="cursor-pointer me-5"
        :class="paymentMethod === 'jazzcash' && 'active'"
      >
        <img
          src="../../../../../public/images/jazzcash.png"
          class="img-fluid"
          alt=""
        />
        <MDBRadio
          type="radio"
          :btnCheck="true"
          name="method"
          value="jazzcash"
          v-model="paymentMethod"
          class="custom-check-input"
        />
      </label>
    </div>
  </div>

  <!-- Payment Preview -->

  <div class="payment-preview">
    <div class="p-4">
      <!-- Master Card Payment -->
      <div class="master-card p-3" v-if="paymentMethod === 'master'">
        <svg
          width="40"
          height="27"
          viewBox="0 0 49 38"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <rect
            x="48.5"
            y="1.16406"
            width="36.3333"
            height="47"
            rx="5.5"
            transform="rotate(90 48.5 1.16406)"
            fill="url(#paint0_linear_108_1760)"
            stroke="#737373"
          />
          <line
            x1="32.168"
            y1="0.664063"
            x2="32.168"
            y2="36.8994"
            stroke="#737373"
          />
          <line
            x1="49"
            y1="9.94922"
            x2="31.6667"
            y2="9.94922"
            stroke="#737373"
          />
          <line x1="49" y1="19.832" x2="31.6667" y2="19.832" stroke="#737373" />
          <line
            x1="49"
            y1="29.1641"
            x2="31.6667"
            y2="29.1641"
            stroke="#737373"
          />
          <line
            x1="18.332"
            y1="19.832"
            x2="0.998697"
            y2="19.832"
            stroke="#737373"
          />
          <line
            x1="18.332"
            y1="29.166"
            x2="2.33203"
            y2="29.166"
            stroke="#737373"
          />
          <path
            d="M14.332 10.498C16.265 10.498 17.832 12.0651 17.832 13.998L17.832 37.498L5.9987 37.498C3.51341 37.498 1.4987 35.4833 1.4987 32.998L1.4987 10.498L14.332 10.498Z"
            stroke="#737373"
          />
          <defs>
            <linearGradient
              id="paint0_linear_108_1760"
              x1="85.202"
              y1="0.664061"
              x2="45.2934"
              y2="40.8392"
              gradientUnits="userSpaceOnUse"
            >
              <stop stop-color="#888888" />
              <stop offset="1" stop-color="#888888" stop-opacity="0" />
            </linearGradient>
          </defs>
        </svg>

        <h5 class="mt-3 mb-2">Waqas Asghar</h5>
        <div class="d-flex card-sample">
          <div class="card-dots">
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
          </div>
          <div class="last-four ps-3 fw-500">
            <small>3469</small>
          </div>
        </div>
        <div class="mt-5 d-flex align-items-end justify-content-between">
          <small class="date fw-500"> 05 / 22 </small>
          <div class="attached-card">
            <span class="d-block text-center">
              <svg
                width="40"
                height="24"
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
            <small class="fw-500 d-block">mastercard</small>
          </div>
        </div>
      </div>
      <!-- Master Card Payment End -->

      <div class="mt-4">
        <small class="d-block fw-500">Booking Summary</small>
        <div class="carted-items mt-2">
          <div class="item rounded-pill">Pixie cut</div>
          <div class="item rounded-pill">Nail paint</div>
          <div class="item rounded-pill">Pixie cut</div>
          <div class="item rounded-pill">Pixie cut</div>
        </div>
        <div class="position-relative hr-parent">
          <hr class="booking-hr mt-5 mx-n1" />
        </div>
        <div class="price-tag pt-2">
          <small class="d-block text-color-1">You have to Pay</small>
          <div class="fw-bold fs-2">
            99.<span class="cents fs-5">99</span>
            <span class="currency ms-1">USD</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from "@vue/reactivity";
import { MDBRadio } from "mdb-vue-ui-kit";

const paymentMethod = ref("master");
</script>

<style scoped>
.booking-hr {
  border-top: 2px dashed #c4c4c4;
  background-color: transparent;
  opacity: 1;
  position: relative;
}

.hr-parent::before,
.hr-parent::after {
  height: 50px;
  width: 50px;
  background-color: #fff;
  border-radius: 50%;
  content: "";
  position: absolute;
  left: -47px;
  top: -23px;
  right: auto;
  z-index: 1000;
}
.hr-parent::after {
  right: -47px;
  left: auto;
}
</style>