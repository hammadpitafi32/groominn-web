<template>
  <MDBContainer class="py-5 my-5">
    <MDBRow>
      <MDBCol :col="serviceChoose ? 7 : 8"> </MDBCol>
      <MDBCol col="4" class="pt-5" v-if="!serviceChoose">
        <h2 class="fw-bold mb-1">Sign Up as a</h2>
        <div class="mt-5 pt-4">
          <MDBBtn
            class="
              rounded-5
              shadow-1-strong
              text-capitalize
              py-3
              bg-orange
              fs-6
              text-white
              w-100
            "
            @click="serviceChoose = true"
          >
            Service Provider
          </MDBBtn>
        </div>
        <div class="d-flex align-items-center my-5">
          <hr class="bg-secondary w-100" />
          <span class="mx-2">or</span>
          <hr class="bg-secondary w-100" />
        </div>

        <div>
          <MDBBtn
            class="border rounded-5 shadow-0 text-capitalize fs-6 py-3 w-100"
            @click="serviceChoose = true"
          >
            No, I’m looking for services
          </MDBBtn>
        </div>
      </MDBCol>
      <MDBCol col="5" class="pt-5" v-else>
        <h2 class="fw-bold mb-1">Get Started</h2>
        <p class="small text-color-1">
          Already have an accoun?
          <router-link to="/login" class="text-orange">Sign in</router-link>
        </p>
        <div class="d-flex mt-4">
          <MDBBtn
            class="shadow-1-strong me-3 text-capitalize flex-grow-1 py-3"
            size="lg"
          >
            <img src="../assets/img/google.svg" class="img-fluid me-2" alt="" />
            Sign up with Google
          </MDBBtn>
          <MDBBtn
            class="
              shadow-2-strong
              ms-3
              facebook-btn
              text-capitalize text-white
              f-w-400
              flex-grow-1
            "
            size="lg"
          >
            <MDBIcon iconStyle="fab" icon="facebook-f" class="me-2"></MDBIcon>
            Sign up with Facebook
          </MDBBtn>
        </div>
        <div class="d-flex align-items-center mt-4">
          <hr class="bg-secondary w-100" />
          <span class="mx-2">or</span>
          <hr class="bg-secondary w-100" />
        </div>

        <form class="mt-3">
          <div class="d-flex mb-4">
            <div class="form-group me-2 flex-grow-1">
              <label for="email" class="mb-1">First Name</label>
              <MDBInput
                size="lg"
                type="text"
                placeholder="Arif"
                class="rounded-6"
              />
            </div>
            <div class="form-group ms-2 flex-grow-1">
              <label for="email" class="mb-1">Last Name</label>
              <MDBInput
                size="lg"
                type="text"
                placeholder="Sattar"
                class="rounded-6"
              />
            </div>
          </div>
          <div class="form-group mb-4">
            <label for="email" class="mb-1">Email Address</label>
            <MDBInput
              size="lg"
              type="email"
              placeholder="Abc@abc.com"
              class="rounded-6"
            />
          </div>
          <div class="form-group mb-4">
            <label for="email" class="mb-1">Phone Number</label>
            <MDBInput
              size="lg"
              type="tel"
              placeholder="0300 78678745"
              class="rounded-6"
            />
          </div>
          <div class="d-flex mb-4">
            <div class="form-group me-3 flex-grow-1">
              <label for="password" class="mb-1">Password</label>
              <MDBInput
                size="lg"
                type="password"
                placeholder="****************"
                class="rounded-6"
              />
            </div>
            <div class="form-group ms-3 flex-grow-1">
              <label for="password" class="mb-1">Confirm Password</label>
              <MDBInput
                size="lg"
                type="password"
                placeholder="****************"
                class="rounded-6"
              />
            </div>
          </div>

          <div class="mt-5 mb-3">
            <label for="terms" class="d-flex align-items-end text-color-1">
              <div class="position-relative">
                <input
                  type="checkbox"
                  id="terms"
                  v-model="terms"
                  class="theme-custom-checkbox"
                />
                <span class="geekmark me-2"></span>
              </div>

              I agree to Platform’s<span class="text-orange mx-1"
                >terms or services
              </span>
              And <span class="text-orange ms-1">Privacy Policy </span>
            </label>
          </div>

          <MDBBtn
            class="
              bg-orange
              text-white text-capitalize
              shadow-4-strong
              w-100
              mt-3
              rounded-5
              fw-bold
            "
            size="lg"
            >Register</MDBBtn
          >
        </form>
      </MDBCol>
    </MDBRow>
  </MDBContainer>
</template>

<script setup>
import { ref } from "@vue/reactivity";
import { MDBInput } from "mdb-vue-ui-kit";

const serviceChoose = ref(false);
const terms = ref(false);
</script>