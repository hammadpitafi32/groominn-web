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
                <input
                    type="text"
                    v-model="name"
                    class="form-control py-3 fw-500"
                />
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
                        maxlength="3"
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
                class="bg-orange text-white fw-500 shadow-0 w-100 mt-2 py-3 rounded-4 text-capitalize fs-6"
                :disabled="!itemsForBooking || loading"
                @click="handlePayment()"
            >
                <span v-if="!loading"> Pay Now </span>
                <BtnLoader v-else />
            </MDBBtn>
        </form>
    </div>

    <!-- Booking Confirm Modal  -->
    <MDBModal
        id="exampleModalCenter"
        tabindex="-1"
        labelledby="exampleModalCenterTitle"
        v-model="bookingSuccess"
        centered
        staticBackdrop
    >
        <MDBModalBody class="py-4">
            <div class="text-center">
                <img
                    src="../../../assets/img/confirmMark.png"
                    class="img-fluid"
                    alt=""
                />
                <h4 class="fw-bold mt-3">Booking Confirmed</h4>
                <div
                    class="est-time fw-500 mt-3 text-orange small d-flex align-items-center justify-content-center"
                >
                    <small> Estimated time </small
                    ><small
                        class="fw-normal text-color-1 d-flex align-items-center"
                        ><svg
                            class="mx-2"
                            width="11"
                            height="11"
                            viewBox="0 0 16 16"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M8 0C3.58214 0 0 3.58214 0 8C0 12.4179 3.58214 16 8 16C12.4179 16 16 12.4179 16 8C16 3.58214 12.4179 0 8 0ZM8 14.6429C4.33214 14.6429 1.35714 11.6679 1.35714 8C1.35714 4.33214 4.33214 1.35714 8 1.35714C11.6679 1.35714 14.6429 4.33214 14.6429 8C14.6429 11.6679 11.6679 14.6429 8 14.6429Z"
                                fill="#B7B7B7"
                            ></path>
                            <path
                                d="M11.1198 10.2609L8.57335 8.4198V4.00016C8.57335 3.92159 8.50907 3.8573 8.4305 3.8573H7.57157C7.493 3.8573 7.42871 3.92159 7.42871 4.00016V8.91801C7.42871 8.96444 7.45014 9.0073 7.48764 9.03409L10.4412 11.1877C10.5055 11.2341 10.5948 11.2198 10.6412 11.1573L11.1519 10.4609C11.1984 10.3948 11.1841 10.3055 11.1198 10.2609Z"
                                fill="#B7B7B7"
                            ></path>
                        </svg>
                        2h 30 mints
                    </small>
                </div>
            </div>
            <div class="text-center mt-5">
                <MDBBtn
                    class="bg-orange text-white rounded-5 px-5 py-2 text-uppercase"
                    @click="
                        (bookingSuccess = false),
                            router.push('/booking-detail'),
                            localStorage.clear()
                    "
                >
                    Ok
                </MDBBtn>
            </div>
        </MDBModalBody>
    </MDBModal>
</template>

<script setup>
import { ref } from "@vue/reactivity";
import { computed, watch, watchEffect } from "@vue/runtime-core";
import { MDBInput } from "mdb-vue-ui-kit";
import { MDBModal, MDBModalBody } from "mdb-vue-ui-kit";
import { createBooking } from "../../../api";
import { useToast } from "vue-toastification";
import router from "../../../router/router";

const emit = defineEmits(["sendData"]);

const props = defineProps({
    data: Object,
});

const itemsForBooking = computed(() => props.data.item_in_cart);
const toast = useToast();

const name = ref("");
const cvv = ref("");
const expMonth = ref("");
const expYear = ref("");
const cardNumber = ref("");
const cardNumberForRequest = ref("");
const errors = ref(null);
const loading = ref(false);
const bookingSuccess = ref(false);

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
    loading.value = true;
    const formData = new FormData();
    formData.append("card_no", cardNumberForRequest.value);
    formData.append("exp_month", expMonth.value);
    formData.append("exp_year", expYear.value);
    formData.append("cvc", cvv.value);
    formData.append("user_business_id", props.data.business_id);

    // formData.append("charges", props.data.charges);
    formData.append("date", props.data.booking_date);
    let serviceIds = itemsForBooking.value.map((item) => item.id);
    formData.append("service_ids", serviceIds);

    createBooking(formData)
        .then((response) => {
            bookingSuccess.value = true;
        })
        .catch((error) => {
            errors.value = error.response.data.errors;
            if (error.response.status == 500) {
                toast.error(error.response.data.message, {
                    timeout: 2000,
                });
            }
        })
        .finally(() => {
            loading.value = false;
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
