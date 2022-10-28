<template>
    <MDBModal
        id="exampleModalCenter"
        tabindex="-1"
        labelledby="exampleModalCenterTitle"
        v-model="props.show"
        centered
        staticBackdrop
    >
        <MDBModalBody>
            <div class="px-4 text-center position-relative">
                <h3 class="fw-bold my-3">
                    {{
                        props.type === "register"
                            ? "Verify Your Account"
                            : "Forgot  your password"
                    }}
                </h3>
                <i
                    class="fas fa-times cursor-pointer position-absolute"
                    v-if="props.type === 'forgetPassword'"
                    @click="emit('closeModal')"
                ></i>
            </div>
            <div class="text-center" v-if="!otpScreen">
                <h6 class="fw-light">Recieve otp through</h6>
                <div
                    class="d-flex align-items-center justify-content-center choose-method my-4"
                >
                    <label
                        for="phoneNumber"
                        :class="{ active: method == 'phone' }"
                    >
                        <input
                            type="radio"
                            class="custom-file-type"
                            id="phoneNumber"
                            value="phone"
                            name="chooseMethod"
                            v-model="method"
                        />
                        <span>Phone number</span>
                    </label>
                    <span class="mx-4">or</span>
                    <label for="email" :class="{ active: method == 'email' }">
                        <input
                            type="radio"
                            class="custom-file-type"
                            id="email"
                            value="email"
                            name="chooseMethod"
                            v-model="method"
                        />
                        <span>Email</span>
                    </label>
                </div>
            </div>
            <div v-else>
                <p class="text-black-50">
                    Lorem Ipsumdolorsamet Conseteturfgadipscin Elitr, Sed Diam
                    Nonumy Od Temporinvidunt La Et Dolore Magna.Ggdfg
                </p>
                <div class="d-flex justify-content-center mt-3">
                    <v-otp-input
                        input-classes="otp-input form-control"
                        :num-inputs="4"
                        :should-auto-focus="true"
                        :is-input-num="true"
                        :conditionalClass="['one', 'two', 'three', 'four']"
                        separator=" "
                        @on-change="handleOnChange"
                        @on-complete="handleOnComplete"
                    />
                </div>
            </div>
            <div class="text-end mt-5 mb-3 pe-3">
                <MDBBtn
                    class="bg-orange text-white text-capitalize mt-3 rounded-5"
                    @click="handleSubmittion()"
                    :disabled="loading || (otpScreen && code.length < 4)"
                >
                    <span v-if="!loading"> Done </span>
                    <BtnLoader v-else />
                </MDBBtn>
            </div>
        </MDBModalBody>
    </MDBModal>
</template>

<script setup>
import { ref } from "@vue/reactivity";
import { MDBModal, MDBModalBody } from "mdb-vue-ui-kit";
import { useToast } from "vue-toastification";
import { useStore } from "vuex";
import { sendUserOtp, verifyOtp } from "../../api";

const props = defineProps(["show", "user", "type"]);
const emit = defineEmits(["closeModal"]);
const method = ref("phone");
const loading = ref(false);
const code = ref("");
const otpScreen = ref(false);
const toast = useToast();
const store = useStore();

const handleOnChange = (val) => {
    code.value = val;
};

const handleOnComplete = (val) => {
    code.value = val;
};

const handleSubmittion = () => {
    loading.value = true;
    const formData = new FormData();
    formData.append("email", props.user.email);
    formData.append("phone", props.user.phoneNumber);
    formData.append("type", method.value);
    if (!otpScreen.value) {
        sendUserOtp(formData)
            .then(({ data }) => {
                toast.success(data.message);
                otpScreen.value = true;
            })
            .catch((error) => {
                toast.error(error.response.data.message);
            })
            .finally(() => {
                loading.value = false;
            });
    } else {
        formData.append("code", code.value);
        verifyOtp(formData)
            .then(({ data }) => {
                toast.success("Accont Created Successfully");
                store.dispatch("setLogin", data);
                store.dispatch("redirection");
                verifyModal.value = false;
            })
            .catch((error) => {
                toast.error(error.response.data.message);
            })
            .finally(() => {
                loading.value = false;
            });
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
