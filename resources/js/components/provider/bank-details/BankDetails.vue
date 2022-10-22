<template>
    <MDBContainer fluid>
        <MDBRow>
            <MDBCol col="12">
                <div class="p-5 pt-4">
                    <h5 class="fw-bold mb-3">Bank Details</h5>
                    <div class="py-5 px-4 rounded-5 bg-light-grey shop-form">
                        <form action="">
                            <div class="form-group mb-3">
                                <label for="name" class="mb-2 fw-bold small"
                                    >Bank Name</label
                                >
                                <MDBInput
                                    id="name"
                                    v-model="bankName"
                                    class="bg-white py-2"
                                />
                            </div>
                            <div class="form-group mb-3">
                                <label for="name" class="mb-2 fw-bold small"
                                    >Bank number</label
                                >
                                <MDBInput
                                    id="number"
                                    v-model="bankNumber"
                                    class="bg-white py-2"
                                />
                            </div>
                            <MDBRow class="mt-4 align-items-end">
                                <MDBCol col="10">
                                    <img src="../../../assets/img/bank-pic.png" class="img-fluid" alt="">
                                </MDBCol>
                                <MDBCol col="2">
                                    <MDBBtn
                                        class="text-white bg-orange shadow-0 text-capitalize px-5 rounded-4 ms-3"
                                        :disabled="loading"
                                    >
                                        <span v-if="!loading">Submit</span>
                                        <BtnLoader v-else />
                                    </MDBBtn>
                                </MDBCol>
                            </MDBRow>
                        </form>
                    </div>
                </div>
            </MDBCol>
        </MDBRow>
    </MDBContainer>
</template>

<script setup>
import { ref, watchEffect } from "@vue/runtime-core";
import { useRouter } from "vue-router";
import { useStore } from "vuex";
import { MDBInput } from "mdb-vue-ui-kit";

const store = useStore();
const router = useRouter();
const bankName = ref("");
const bankNumber = ref("");
const loading = ref(false);

watchEffect(() => {
    if (!store.state.auth) {
        router.push("/login");
    } else if (store.state.role == "Client" || !store.state.shop) {
        router.push("/");
    }
});
</script>
