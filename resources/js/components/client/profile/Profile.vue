<template>
    <MDBContainer class="mt-5 pt-5">
        <MDBRow>
            <MDBCol col="10" class="mx-auto mt-5">
                <div class="user-profile p-3">
                    <div class="d-flex align-items-center">
                        <svg
                            width="35"
                            height="33"
                            viewBox="0 0 40 38"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <g filter="url(#filter0_d_108_204)">
                                <path
                                    d="M34 0H6C4.34315 0 3 1.34315 3 3V29C3 30.6569 4.34315 32 6 32H34C35.6569 32 37 30.6569 37 29V3C37 1.34315 35.6569 0 34 0Z"
                                    fill="white"
                                />
                            </g>
                            <path
                                d="M16.4469 12.0355C16.4469 10.1932 18.0145 8.65 19.9945 8.65C21.9745 8.65 23.5422 10.1932 23.5422 12.0355C23.5422 13.8778 21.9745 15.421 19.9945 15.421C18.0145 15.421 16.4469 13.8778 16.4469 12.0355Z"
                                stroke="#67748E"
                                stroke-width="1.3"
                            />
                            <path
                                d="M15.2274 19.1735L15.2274 19.1735C16.2543 18.1711 17.6145 17.6187 19.0633 17.6187H20.9289C22.3777 17.6187 23.7378 18.1711 24.7647 19.1735C25.7366 20.1222 26.2867 21.3511 26.3382 22.656H13.654C13.7054 21.3511 14.2556 20.1222 15.2274 19.1735Z"
                                stroke="#67748E"
                                stroke-width="1.3"
                            />
                            <defs>
                                <filter
                                    id="filter0_d_108_204"
                                    x="0"
                                    y="0"
                                    width="40"
                                    height="38"
                                    filterUnits="userSpaceOnUse"
                                    color-interpolation-filters="sRGB"
                                >
                                    <feFlood
                                        flood-opacity="0"
                                        result="BackgroundImageFix"
                                    />
                                    <feColorMatrix
                                        in="SourceAlpha"
                                        type="matrix"
                                        values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
                                        result="hardAlpha"
                                    />
                                    <feOffset dy="3" />
                                    <feGaussianBlur stdDeviation="1.5" />
                                    <feColorMatrix
                                        type="matrix"
                                        values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.169 0"
                                    />
                                    <feBlend
                                        mode="normal"
                                        in2="BackgroundImageFix"
                                        result="effect1_dropShadow_108_204"
                                    />
                                    <feBlend
                                        mode="normal"
                                        in="SourceGraphic"
                                        in2="effect1_dropShadow_108_204"
                                        result="shape"
                                    />
                                </filter>
                            </defs>
                        </svg>
                        <h6 class="fw-bold mb-0 ms-2">Profile</h6>
                    </div>

                    <MDBRow>
                        <MDBCol col="12">
                            <div
                                class="py-3 px-4 rounded-5 bg-light-grey shop-form mt-4"
                            >
                                <form action="">
                                    <div class="form-gruop mb-3">
                                        <label for="" class="fw-bold mb-2"
                                            >First Name</label
                                        >
                                        <MDBInput class="py-2" 
                                        :class="errors && errors.first_name &&'border-danger'"
                                        v-model="firstName"
                                        />
                                        <span v-if="errors && errors.first_name"
                                        class="text-danger small"
                                        >{{ errors.first_name[0] }}</span>
                                    </div>
                                    <div class="form-gruop mb-3">
                                        <label for="" class="fw-bold mb-2"
                                            >Last Name</label
                                        >
                                        <MDBInput class="py-2" 
                                        :class="errors && errors.last_name &&'border-danger'"
                                        v-model="lastName"
                                        />
                                        <span v-if="errors && errors.last_name"
                                        class="text-danger small"
                                        >{{ errors.last_name[0] }}</span>
                                    </div>
                                    <div class="form-gruop mb-3">
                                        <label for="" class="fw-bold mb-2"
                                            >Phone Number</label
                                        >
                                        <MDBInput
                                            type="text"
                                            class="py-2"
                                            :class="errors && errors.phone &&'border-danger'"
                                            v-model="phoneNumber"
                                        />
                                        <span v-if="errors && errors.phone"
                                        class="text-danger small"
                                        >{{ errors.phone[0] }}</span>
                                    </div>
                                    <div class="form-gruop mb-3">
                                        <label for="" class="fw-bold mb-2"
                                            >Email</label
                                        >
                                        <MDBInput
                                            type="email"
                                            class="py-2"
                                            :class="errors && errors.email &&'border-danger'"
                                            v-model="email"
                                        />
                                        <span v-if="errors && errors.email"
                                        class="text-danger small"
                                        >{{ errors.email[0] }}</span>
                                    </div>
                                    <div class="form-gruop mb-3">
                                        <label for="" class="fw-bold mb-2"
                                            >Current Password</label
                                        >
                                        <MDBInput
                                            type="password"
                                            class="py-2"
                                            :class="errors && errors.current_password &&'border-danger'"
                                            v-model="currentPassword"

                                        />
                                        <span v-if="errors && errors.current_password"
                                        class="text-danger small"
                                        >{{ errors.current_password[0] }}</span>
                                    </div>
                                    <div class="form-gruop mb-3">
                                        <label for="" class="fw-bold mb-2"
                                            >New Password</label
                                        >
                                        <MDBInput
                                            type="password"
                                            class="py-2"
                                            :class="errors && errors.password &&'border-danger'"
                                            v-model="newPassword"
                                        />
                                        <span v-if="errors && errors.password"
                                        class="text-danger small"
                                        >{{ errors.password[0] }}</span>
                                    </div>
                                    <div class="form-gruop mb-3">
                                        <label for="" class="fw-bold mb-2"
                                            >Confirm New Password</label
                                        >
                                        <MDBInput
                                            type="password"
                                            class="py-2"
                                            :class="errors && errors.confirm_password &&'border-danger'"
                                            v-model="confirmNewPassword"
                                        />
                                        <span v-if="errors && errors.confirm_password"
                                        class="text-danger small"
                                        >{{ errors.confirm_password[0] }}</span>
                                    </div>
                                    <div class="text-end pt-3">
                                        <MDBBtn
                                            @click="saveUserHandler()"
                                            class="bg-orange text-white text-capitalize"
                                            >Save Changes</MDBBtn
                                        >
                                    </div>
                                </form>
                            </div>
                        </MDBCol>
                    </MDBRow>
                </div>
            </MDBCol>
        </MDBRow>
    </MDBContainer>
</template>

<script setup>
import {ref, watchEffect } from "@vue/runtime-core";
import { MDBInput } from "mdb-vue-ui-kit";
import { useStore } from "vuex";
import { useToast } from "vue-toastification";

import {
    getUserData,
    saveUserData,
} from "../../../api";

const store = useStore();

const toast = useToast();

const firstName = ref("");
const lastName = ref("");
const email = ref("");

const phoneNumber = ref("");
const currentPassword  = ref("");
const newPassword = ref("");
const confirmNewPassword = ref("");
const user_detail = ref(null);

const errors = ref(null);

watchEffect(() => {
    store.dispatch("clientRedirection");
});
getUserData().then(({ data }) => {
    user_detail.value = data.data;
    // console.log(user_detail.value);
    if(user_detail.value)
    {
        firstName.value = user_detail.value.first_name;
        if(user_detail.value.last_name)
        {

            lastName.value = user_detail.value.last_name;
        }
        phoneNumber.value = user_detail.value.user_detail.phone;
        email.value = user_detail.value.email;
    }
});
const saveUserHandler = () => {
    const formData = new FormData();
    if (user_detail.value) {
        formData.append("id", user_detail.value.id);
    }
    formData.append("first_name", firstName.value);
    formData.append("last_name", lastName.value);
    formData.append("phone", phoneNumber.value);
    formData.append("email", email.value);
    formData.append("current_password", currentPassword.value);
    formData.append("password", newPassword.value);
    formData.append("password_confirmation", confirmNewPassword.value);

    saveUserData(formData)
        .then((response) => {
            errors.value = null;
            if(response.data.success == true)
            {
                user_detail.value = response.data.data;
            }
            toast.success("Changes Saved Successfully!");
        })
        .catch((err) => {
            errors.value = err.response.data.errors;
        });
};
</script>
