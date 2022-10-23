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
                                        <MDBInput id="firstName" class="py-2" />
                                    </div>
                                    <div class="form-gruop mb-3">
                                        <label for="" class="fw-bold mb-2"
                                            >Last Name</label
                                        >
                                        <MDBInput id="lastName" class="py-2" />
                                    </div>
                                    <div class="form-gruop mb-3">
                                        <label for="" class="fw-bold mb-2"
                                            >Email</label
                                        >
                                        <MDBInput
                                            id="email"
                                            type="email"
                                            class="py-2"
                                        />
                                    </div>
                                    <div class="form-gruop mb-3">
                                        <label for="" class="fw-bold mb-2"
                                            >Password</label
                                        >
                                        <MDBInput
                                            type="password"
                                            id="password"
                                            class="py-2"
                                        />
                                    </div>
                                    <div class="text-end pt-3">
                                        <MDBBtn
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
import { watchEffect } from "@vue/runtime-core";
import { MDBInput } from "mdb-vue-ui-kit";
import { useStore } from "vuex";

const store = useStore();

watchEffect(() => {
    store.dispatch("clientRedirection");
});
</script>
