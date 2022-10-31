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
                                    v-model="bankName"
                                    :class="
                                        errors &&
                                        errors.bank_name &&
                                        'border-danger'
                                    "
                                    class="bg-white py-2"
                                />
                                <span
                                    v-if="errors && errors.bank_name"
                                    class="text-danger small"
                                    >{{ errors.bank_name[0] }}</span
                                >
                            </div>
                            <div class="form-group mb-3">
                                <label for="name" class="mb-2 fw-bold small"
                                    >Bank number</label
                                >
                                <MDBInput
                                    v-model="bankNumber"
                                    :class="
                                        errors &&
                                        errors.account_number &&
                                        'border-danger'
                                    "
                                    class="bg-white py-2"
                                />
                                <span
                                    v-if="errors && errors.account_number"
                                    class="text-danger small"
                                    >{{ errors.account_number[0] }}</span
                                >
                            </div>
                            <MDBRow class="mt-4 align-items-end">
                                <MDBCol col="10">
                                    <img
                                        src="../../../assets/img/bank-pic.png"
                                        class="img-fluid"
                                        alt=""
                                    />
                                </MDBCol>
                                <MDBCol col="2">
                                    <MDBBtn
                                        @click="addNewBankHandler()"
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
import { useToast } from "vue-toastification";

import { createUserBank, getUserBank } from "../../../api";

const toast = useToast();

const store = useStore();
const router = useRouter();
const bankName = ref("");
const bankNumber = ref("");
const loading = ref(false);
const errors = ref(null);
const bank_detail = ref(null);

watchEffect(() => {
    // store.dispatch("providerRedirection");
});

getUserBank().then(({ data }) => {
    bank_detail.value = data.data;
    if (bank_detail.value) {
        bankName.value = bank_detail.value.bank_name;
        bankNumber.value = bank_detail.value.account_number;
    }
});

const addNewBankHandler = () => {
    const formData = new FormData();
    if (bank_detail.value) {
        formData.append("id", bank_detail.value.id);
    }
    formData.append("bank_name", bankName.value);
    formData.append("account_number", bankNumber.value);

    createUserBank(formData)
        .then((response) => {
            errors.value = null;
            if (response.data.success == true) {
                bank_detail.value = response.data.data;
            }
            toast.success("Changes Saved Successfully!");
        })
        .catch((err) => {
            errors.value = err.response.data.errors;
        });
};
</script>
