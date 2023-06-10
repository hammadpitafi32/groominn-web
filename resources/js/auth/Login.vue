<template>
    <MDBContainer class="pt-5 mt-5 px-5">
        <MDBRow>
            <MDBCol col="col-12 col-sm-7">
                <img style="width: 100% !important;" 
                    src="../assets/img/signin-img.png"
                    class="img-fluid"
                    alt=""
                />
            </MDBCol>
            <MDBCol col="col-12 col-sm-5" class="py-5">
                <h2 class="fw-bold mb-1 heading2">Get Started</h2>
                <p class="small text-color-1">
                    Dont have an account?
                    <router-link to="/register" class="text-orange"
                        >Sign up</router-link
                    >
                </p>
    <!--             <div class="d-flex mt-4">
                    <MDBBtn
                        class="shadow-1-strong me-3 text-capitalize flex-grow-1 py-3"
                        size="lg"
                        @click="handleGoogleLogin()"
                    >
                        <img
                            src="../assets/img/google.svg"
                            class="img-fluid me-2"
                            alt=""
                        />
                        Sign in with Google
                    </MDBBtn>
                    <MDBBtn
                        class="shadow-2-strong ms-3 facebook-btn text-capitalize text-white f-w-400 flex-grow-1"
                        size="lg"
                        @click="handleFacebookLogin()"
                    >
                        <MDBIcon
                            iconStyle="fab"
                            icon="facebook-f"
                            class="me-2"
                        ></MDBIcon>
                        Sign in with Facebook
                    </MDBBtn>
                </div> -->
                <div class="d-flex align-items-center mt-4">
                    <hr class="bg-secondary w-100" />
                    <span class="mx-2">or</span>
                    <hr class="bg-secondary w-100" />
                </div>

                <form>
                    <div class="form-group mb-4">
                        <label for="email" class="mb-1">Email Address</label>
                        <MDBInput
                            size="lg"
                            type="email"
                            v-model="credentials.email"
                            placeholder="Abc@abc.com"
                            class="rounded-6"
                        />
                    </div>
                    <div class="form-group mb-2">
                        <label for="password" class="mb-1">Password</label>
                        <MDBInput
                            size="lg"
                            type="password"
                            v-model="credentials.password"
                            placeholder="****************"
                            class="rounded-6"
                        />
                    </div>
                    <div class="d-flex align-items-center mb-4">
                        <span class="text-color-1" v-if="showVeficationText"
                            >Need Verification?
                            <span
                                class="fw-bold text-orange cursor-pointer"
                                @click="showModal('register')"
                                >Verify</span
                            ></span
                        >
                        <span
                            class="text-color-1 cursor-pointer ms-auto"
                            @click="showModal('forgetPassword')"
                            >Forgot password?</span
                        >
                    </div>
                    <MDBBtn
                        class="bg-orange btn-loginn text-white text-capitalize shadow-4-strong w-100 mt-3 rounded-5 fw-bold"
                        :disabled="loading"
                        size="lg"
                        @click="handleLogin()"
                    >
                        <span v-if="!loading"> Login </span>
                        <BtnLoader v-else />
                    </MDBBtn>
                </form>
            </MDBCol>
        </MDBRow>
        <AccountVerify
            :show="showVerifyAccount"
            :type="verificationType"
            :user="userForVerify"
            @closeModal="closeModal()"
        />
    </MDBContainer>
</template>

<script setup>

import { ref, reactive } from "@vue/reactivity";
import { watch, watchEffect } from "@vue/runtime-core";
import { MDBInput } from "mdb-vue-ui-kit";
import { useCookies } from "vue3-cookies";
import { login } from "../api";
import { useStore } from "vuex";
import { useRouter } from "vue-router";
import { useToast } from "vue-toastification";
import AccountVerify from "../components/modals/AccountVerify.vue";

const loading = ref(false);
const credentials = reactive({
    email: "",
    password: "",
});

const verificationType = ref("forgetPassword");
const apiResponse = ref(null);
const { cookies } = useCookies();
const store = useStore();
const router = useRouter();
const toast = useToast();
const showVerifyAccount = ref(false);
const showVeficationText = ref(false);
const userForVerify = reactive({
    email: "",
    phone: "",
});

const closeModal = () => {
    showVerifyAccount.value = false;
};

const showModal = (type) => {
    verificationType.value = type;
    showVerifyAccount.value = true;
};

watchEffect(() => {
    store.dispatch("redirection");
});

const handleGoogleLogin = () => {
    let baseUrl=process.env.MIX_APP_API_URL+'/auth/google';

    window.open(baseUrl);
};
const handleFacebookLogin = () => {
    let baseUrl=process.env.MIX_APP_API_URL+'/auth/facebook';
 
    window.open(baseUrl);
};

const handleLogin = () => {
    const formData = new FormData();
    formData.append("email", credentials.email);
    formData.append("password", credentials.password);
    if (credentials.email && credentials.password) {
        loading.value = true;
        login(formData)
            .then((res) => {
                apiResponse.value = res.data;
                toast.success("Login Successfully!");
                store.dispatch("setLogin", res.data);
                store.dispatch("redirection");
            })
            .catch((error) => {
                let errorData = error.response.data;
                if (errorData.action_require) {
                    showVeficationText.value = true;
                    userForVerify.email = errorData.data.email;
                    userForVerify.phone = errorData.data.user_detail.phone;
                }
                toast.error(error.response.data.message, {
                    timeout: 2000,
                });
                apiResponse.value = error.response.data;
            })
            .finally(() => {
                loading.value = false;
            });
    }
};
</script>
