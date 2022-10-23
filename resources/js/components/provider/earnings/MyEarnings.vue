<template>
    <section class="px-5 pt-4">
        <MDBContainer fluid>
            <MDBRow>
                <MDBCol col="12">
                    <h5 class="fw-bold">My earnings</h5>
                </MDBCol>
            </MDBRow>
            <MDBRow class="mt-5">
                <MDBCol col="4">
                    <div class="earning-box">
                        <div>
                            <span class="text-orange mb-0 fw-bold"
                                >Total Earnings</span
                            >
                            <h4 class="mb-0">{{ earnings?.total_earning }}</h4>
                        </div>
                        <div class="dollar-img">
                            <img
                                src="../../../assets/img/dollar-img.png"
                                class="img-fluid"
                                alt=""
                            />
                        </div>
                    </div>
                </MDBCol>
                <MDBCol col="4">
                    <div class="earning-box">
                        <div>
                            <span class="text-orange mb-0 fw-bold"
                                >Weekly Earnings</span
                            >
                            <h4 class="mb-0">
                                {{ earnings?.total_weekly_earning }}
                            </h4>
                        </div>
                        <div class="dollar-img">
                            <img
                                src="../../../assets/img/dollar-img.png"
                                class="img-fluid"
                                alt=""
                            />
                        </div>
                    </div>
                </MDBCol>
                <MDBCol col="4">
                    <div class="earning-box">
                        <div>
                            <span class="text-orange mb-0 fw-bold"
                                >Yearly Earnings</span
                            >
                            <h4 class="mb-0">
                                {{ earnings?.total_year_earning }}
                            </h4>
                        </div>
                        <div class="dollar-img">
                            <img
                                src="../../../assets/img/dollar-img.png"
                                class="img-fluid"
                                alt=""
                            />
                        </div>
                    </div>
                </MDBCol>
            </MDBRow>
        </MDBContainer>
    </section>
</template>

<script setup>
import { ref, watchEffect } from "@vue/runtime-core";
import { useRouter } from "vue-router";
import { useStore } from "vuex";
import { getEarnings } from "../../../api";

const store = useStore();
const router = useRouter();
const earnings = ref(null);

getEarnings().then(({ data }) => {
    earnings.value = data.data;
});

watchEffect(() => {
    store.dispatch("providerRedirection");
});
</script>
