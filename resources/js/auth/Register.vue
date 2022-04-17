<template>
  <MDBContainer class="py-5 my-5">
    <MDBRow>
      <MDBCol :col="!serviceChoose ? '8' : '7'"> </MDBCol>
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
            @click="serviceChoose = 'provider'"
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
            @click="serviceChoose = 'client'"
          >
            No, I’m looking for services
          </MDBBtn>
        </div>
      </MDBCol>
      <MDBCol col="5" class="pt-5" v-else>
        <div v-if="success" class="alert alert-success">
          Registered Successfully!
        </div>
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
              <label for="firstName" class="mb-1">First Name</label>
              <MDBInput
                size="lg"
                type="text"
                placeholder="Arif"
                :class="errors && errors.first_name && 'border-danger'"
                v-model="firstName"
              />
              <span
                v-if="errors && errors.first_name"
                class="text-danger small"
                >{{ errors.first_name[0] }}</span
              >
            </div>
            <div class="form-group ms-2 flex-grow-1">
              <label for="lastName" class="mb-1">Last Name</label>
              <MDBInput
                size="lg"
                type="text"
                placeholder="Sattar"
                :class="errors && errors.last_name && 'border-danger'"
                v-model="lastName"
              />
              <span
                v-if="errors && errors.last_name"
                class="text-danger small"
                >{{ errors.last_name[0] }}</span
              >
            </div>
          </div>
          <div class="form-group mb-4">
            <label for="email" class="mb-1">Email Address</label>
            <MDBInput
              size="lg"
              type="email"
              placeholder="Abc@abc.com"
              :class="errors && errors.email && 'border-danger'"
              v-model="email"
            />
            <span v-if="errors && errors.email" class="text-danger small">{{
              errors.email[0]
            }}</span>
          </div>
          <div class="form-group mb-4">
            <label for="phoneNumber" class="mb-1">Phone Number</label>
            <MDBInput
              size="lg"
              type="tel"
              :class="errors && errors.phone && 'border-danger'"
              placeholder="0300 78678745"
              v-model="phoneNumber"
            />
            <span v-if="errors && errors.phone" class="text-danger small">{{
              errors.phone[0]
            }}</span>
          </div>
          <div class="row mb-2">
            <div class="form-group col-6">
              <label for="password" class="mb-1">Password</label>
              <MDBInput
                size="lg"
                type="password"
                placeholder="**********"
                :class="errors && errors.password && 'border-danger'"
                v-model="password"
              />
              <span
                v-if="errors && errors.password"
                class="text-danger small mt-1"
              >
                <span
                  class="mb-1 d-block"
                  v-for="(passErr, index) in errors.password"
                  :key="index"
                >
                  {{ passErr }}
                </span></span
              >
            </div>
            <div class="form-group col-6">
              <label for="confirmPassword" class="mb-1">Confirm Password</label>
              <MDBInput
                size="lg"
                type="password"
                placeholder="**********"
                :class="errors && errors.password && 'border-danger'"
                v-model="confirmPassword"
              />
            </div>
          </div>
          <span v-if="confirmPasswordError" class="text-danger">{{
            confirmPasswordError
          }}</span>

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
            @click="registerHandler()"
            :disabled="!terms || loading"
            size="lg"
          >
            <span v-if="!loading"> Register </span>
            <BtnLoader v-else />
          </MDBBtn>
        </form>
      </MDBCol>
    </MDBRow>
  </MDBContainer>
</template>

<script setup>
import { ref } from "@vue/reactivity";
import { useStore } from "vuex";
import { useRouter } from "vue-router";
import { MDBInput } from "mdb-vue-ui-kit";
import { register } from "../api";
import BtnLoader from "../components/custom-components/BtnLoader.vue";

const store = useStore();
const router = useRouter();

const serviceChoose = ref("");
const loading = ref(false);
const terms = ref(false);
const firstName = ref("");
const lastName = ref("");
const email = ref("");
const phoneNumber = ref("");
const password = ref("");
const confirmPassword = ref("");
const confirmPasswordError = ref("");

const errors = ref(null);
const success = ref(null);

const registerHandler = () => {
  loading.value = true;
  const formData = new FormData();
  formData.append("first_name", firstName.value);
  formData.append("last_name", lastName.value);
  formData.append("email", email.value);
  formData.append("password", password.value);
  formData.append("password_confirmation", confirmPassword.value);
  formData.append("role", serviceChoose.value);
  formData.append("phone", phoneNumber.value);

  register(formData)
    .then(({ data }) => {
      errors.value = null;
      success.value = data.success;
      store.dispatch("setLogin", data).then(() => {
        if (res.data.isShop) {
          router.push("/my-shop");
        } else {
          router.push("/add-shop");
        }
      });
      window.scrollTo({ top: 0 });
      setTimeout(() => {
        router.push("/add-shop");
      }, 600);
    })
    .catch(({ response }) => {
      loading.value = false;
      errors.value = response.data.errors;
      success.value = null;
    });
  confirmPasswordError.value = "";
};
</script>

