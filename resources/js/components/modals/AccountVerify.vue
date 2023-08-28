<template>
    <MDBModal id="exampleModalCenter" tabindex="-1" labelledby="exampleModalCenterTitle" v-model="props.show" centered staticBackdrop>
        <MDBModalBody>
            <div class="px-4 text-center position-relative">
                <h3 class="fw-bold my-3">
                    {{
                    props.type === "register"
                    ? "Verify Your Account"
                    : "Forgot your password"
                    }}
                </h3>
                <i class="fas fa-times cursor-pointer position-absolute" v-if="props.type === 'forgetPassword'" @click="emit('closeModal')"></i>
            </div>
            <div class="text-center" v-if="screen == 'chooseMethod'">
                <h6 class="fw-light">Recieve otp through</h6>
                <div class="d-flex align-items-center justify-content-center choose-method my-4">
                    <label for="phoneNumber" :class="{ active: method == 'phone' }">
                        <input type="radio"  class="custom-file-type" id="phoneNumber" value="phone" name="chooseMethod" v-model="method" />
                        <span>Phone number</span>
                    </label>
                    <span class="mx-4">or</span>
                    <label for="email" :class="{ active: method == 'email' }">
                        <input type="radio" class="custom-file-type" id="email" value="email" name="chooseMethod" v-model="method" />
                        <span>Email</span>
                    </label>
                </div>
            </div>
            <div v-if="screen == 'otpVerification'">
                <p style="text-align: center;" class="text-black-50">
                    Please Enter your 4 digits code here.
                </p>
                <div class="d-flex justify-content-center mt-3">
                    <v-otp-input input-classes="otp-input form-control" :num-inputs="4" :should-auto-focus="true" :is-input-num="true" :conditionalClass="['one', 'two', 'three', 'four']" separator=" " @on-change="handleOnChange" @on-complete="handleOnComplete" />
                </div>
            </div>
            <div v-if="screen == 'enterCredential'" class="px-5 mt-4">
                <label :for="method" class="mb-1">Enter your {{ method }}</label>
                <input :id="method" :type="method" v-if="method == 'email'" class="form-control" v-model="emailForForgetPass" />
                <input :id="method" :type="method" v-else class="form-control" v-model="phoneForForgetPass" />
            </div>
            <div v-if="screen == 'confirmPassword'" class="px-5 mt-4">
                <label for="password" class="mb-1">New Password</label>
                <input id="password" type="password" class="form-control mb-3" v-model="newPassword" />
                <label for="confirm-password">Confirm New Password</label>
                <input id="confirm-password" type="password" class="form-control mb-3" v-model="newConfirmPassword" />
            </div>
            <div class="text-end mt-5 mb-3 pe-3">
                <MDBBtn class="bg-orange text-white text-capitalize mt-3 rounded-5" @click="
                        props.type == 'register'
                            ? handleVerification()
                            : handleForgetPassword()
                    " :disabled="
                        loading ||
                        (screen == 'otpVerification' && code.length < 4)
                    ">
                    <span v-if="!loading"> Done </span>
                    <BtnLoader v-else />
                </MDBBtn>
            </div>
        </MDBModalBody>
    </MDBModal>
</template>
<script setup>
import { ref } from "@vue/reactivity";
import { watch } from "@vue/runtime-core";
import { MDBModal, MDBModalBody } from "mdb-vue-ui-kit";
import { useToast } from "vue-toastification";
import { useStore } from "vuex";
import { resetPassword, sendUserOtp, verifyOtp } from "../../api";

const props = defineProps(["show", "user", "type"]);
const emit = defineEmits(["closeModal"]);
const method = ref("phone");
const loading = ref(false);
const code = ref("");
const otpScreen = ref(false);
const toast = useToast();
const store = useStore();
const screen = ref("chooseMethod");
const emailForForgetPass = ref("");
const phoneForForgetPass = ref("");
const newPassword = ref("");
const newConfirmPassword = ref("");
const userDataForLogin = ref(null);

const handleOnChange = (val) => {
    code.value = val;
};

const handleOnComplete = (val) => {
    code.value = val;
};

watch(props, () => {
    screen.value = "chooseMethod";
});

const OtpHandler = async (formData) => {
    loading.value = true;
    let result;
    await sendUserOtp(formData)
        .then(({ data }) => {
            toast.success(data.message);
            result = true;
        })
        .catch((error) => {
            toast.error(error.response.data.message);
            result = false;
        })
        .finally(() => {
            loading.value = false;
        });
    return result;
};

const verifyOtpHandler = async (formData) => {
    loading.value = true;
    let result;
    await verifyOtp(formData)
        .then(({ data }) => {
            toast.success("Accont Verified Successfully");
            userDataForLogin.value = data;
            result = true;
        })
        .catch((error) => {
            toast.error(error.response.data.message);
            result = false;
        })
        .finally(() => {
            loading.value = false;
        });
    return result;
};

const handleVerification = async () => {
    loading.value = true;
    const formData = new FormData();
    formData.append("email", props.user.email);
    formData.append("phone", props.user.phone);
    formData.append("type", method.value);
    if (screen.value == "chooseMethod") {
        let result = await OtpHandler(formData);
        if (result) screen.value = "otpVerification";
    } else if (screen.value == "otpVerification") {
        formData.append("code", code.value);
        let result = await verifyOtpHandler(formData);
        if (result) {
            store.dispatch("setLogin", userDataForLogin.value);
            store.dispatch("redirection");
            emit("closeModal");
        }
    }
};

const handleForgetPassword = async () => {
    const formData = new FormData();
    formData.append("email", emailForForgetPass.value);
    formData.append("phone", phoneForForgetPass.value);
    formData.append("type", method.value);
    if (screen.value == "chooseMethod") {
        screen.value = "enterCredential";
    } else if (screen.value == "enterCredential") {
        let result = await OtpHandler(formData);
        if (result) screen.value = "otpVerification";
    } else if (screen.value == "otpVerification") {
        formData.append("code", code.value);
        let result = await verifyOtpHandler(formData);
        if (result) screen.value = "confirmPassword";
    } else if (screen.value == "confirmPassword") {
        if (newPassword.value && newConfirmPassword.value) {
            if (newPassword.value != newConfirmPassword.value) {
                toast.error("Password should be matched!");
                return;
            }
            formData.append("password", newPassword.value);
            loading.value = true;
            resetPassword(formData).then(({ data }) => {
                loading.value = false;
                emit("closeModal");
                store.dispatch("setLogin", data);
                store.dispatch("redirection");
                toast.success("Password has been Successfully!");
            });
        }
    }
};

</script>
<style scoped>
.choose-method label {
    border: 1px solid var(--theme-orange-color);
    color: var(--theme-orange-color);
    padding: 0.6rem 1.5rem;
    border-radius: 12px;
    font-size: 13px;
    position: relative;
}

.choose-method label.active {
    background-color: var(--theme-orange-color);
    color: #fff;
}

.choose-method input {
    cursor: pointer;
}

.fa-times {
    right: 7px;
    top: -13px;
    font-size: 20px;
}

</style>
