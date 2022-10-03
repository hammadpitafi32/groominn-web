<template>
    <MDBContainer class="mt-5 py-5">
        <MDBRow center class="my-4">
            <MDBCol col="6">
                <PaymentDetail @sendData="sendData" :data="data" />
            </MDBCol>
            <MDBCol col="4">
                <PaymentMethod :data="data" />
            </MDBCol>
        </MDBRow>
    </MDBContainer>
</template>

<script setup>
import { ref, watchEffect, computed } from "@vue/runtime-core";
import PaymentDetail from "./PaymentDetail.vue";
import PaymentMethod from "./PaymentMethod.vue";
import { useStore } from "vuex";
import { useRoute, useRouter } from "vue-router";

const store = useStore();
const route = useRoute();
const router = useRouter();
const itemsInCart = ref(null);
const business_id = ref(null);
const booking_date = ref(null);
const data = ref({});

watchEffect(() => {
    store.dispatch("clientRedirection");
    store.dispatch("setAuth");
    if (route.params.data) {
        // setting Data in localStorage in real time
        let dataForPayment = JSON.parse(route.params.data);
        let jsondata = dataForPayment.items.map((item) => JSON.parse(item));
        itemsInCart.value = jsondata;

        business_id.value = dataForPayment.user_business_id;
        booking_date.value = dataForPayment.booking_date;

        localStorage.setItem(
            "data",
            JSON.stringify({
                items: JSON.stringify(jsondata),
                id: dataForPayment.user_business_id,
                date: dataForPayment.booking_date,
            })
        );
    } else if (localStorage.getItem("data")) {
        // If page is refresh then get data from localStorage

        // fetching data from localStorage
        let items = localStorage.getItem("data");
        itemsInCart.value = JSON.parse(JSON.parse(items).items);
        business_id.value = JSON.parse(items).id;
        booking_date.value = JSON.parse(items).date;
    } else {
        router.push("/booking-list");
    }
});

const itemsPrice = computed(() => {
    if (itemsInCart.value) {
        let price = itemsInCart.value.reduce(
            (count, item) => count + item.price,
            0
        );
        return price.toFixed(2);
    }
});

const sendData = (val) => {
    data.value = {
        ...val,
        item_in_cart: itemsInCart.value,
        business_id: business_id.value,
        booking_date: booking_date.value,
        charges: itemsPrice.value,
    };
};
</script>
