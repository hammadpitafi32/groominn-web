<template>
  <MDBContainer class="pt-5 mt-5">
    <MDBRow>
      <MDBCol col="7"> </MDBCol>
      <MDBCol col="5" class="pt-5">
        <h2 class="fw-bold mb-1">Get Started</h2>
        <p class="small text-color-1">
          Dont have an account?
          <router-link to="/register" class="text-orange">Sign up</router-link>
        </p>
        <div class="d-flex mt-4">
          <MDBBtn
            class="shadow-1-strong me-3 text-capitalize flex-grow-1 py-3"
            size="lg"
          >
            <img src="../assets/img/google.svg" class="img-fluid me-2" alt="" />
            Sign in with Google
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
            Sign in with Facebook
          </MDBBtn>
        </div>
        <div class="d-flex align-items-center mt-4">
          <hr class="bg-secondary w-100" />
          <span class="mx-2">or</span>
          <hr class="bg-secondary w-100" />
        </div>

        <form>
          <div class="form-group mb-4">
            <label for="email" class="mb-1">Email Address</label>
            <MDBInput size="lg" type="email" placeholder="Abc@abc.com" class="rounded-6" />
          </div>
          <div class="form-group mb-2">
            <label for="password" class="mb-1">Password</label>
            <MDBInput size="lg" type="password" placeholder="****************" class="rounded-6" />
          </div>
          <div class="text-end mb-4">
              <router-link class="text-color-1" to="/">Forgot password?</router-link>
          </div>
          <MDBBtn class="bg-orange text-white text-capitalize shadow-4-strong w-100 mt-3 rounded-5 fw-bold" size="lg">Login</MDBBtn>
        </form>
      </MDBCol>
    </MDBRow>
  </MDBContainer>
</template>

<script setup>
import { MDBInput } from "mdb-vue-ui-kit";
</script>