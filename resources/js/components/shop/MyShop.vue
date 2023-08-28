<template>
    <div v-if="!loading">
        <div v-if='isVerified == "inactive"' class="alert alert-danger" role="alert">
            Your business request sent to admin for approval, Your Business can be listed after approval.
        </div>
        <MDBContainer
            v-if="apiResponse && apiResponse.data"
            :class="route.name == 'shopDetail' && 'mt-5 pt-4'"
        >
            <MDBRow
                class="pt-4 mx-3"
                :class="route.name == 'shopDetail' && 'mt-5'"
            >
                <MDBCol col="12" class="pb-4 text-end" v-if="store.state.role === 'Provider'">
                    <MDBBtn
                        class="bg-orange text-white rounded-4 text-capitalize fw-normal edit-btn"
                        @click="router.push(`/edit-shop/${apiResponse.data.id}`)"
                    >
                        Edit Shop
                    </MDBBtn>
                </MDBCol>
                <MDBCol col="12 col-sm-5">
                    <ShopPhotos
                        :photos="apiResponse.data.user_business_images"
                    />
                </MDBCol>
                <MDBCol col="12 col-sm-7">
                    <ShopDetails :data="apiResponse.data" />
                </MDBCol>
            </MDBRow>
        </MDBContainer>
    </div>
    <MDBContainer v-else>
        <MDBRow :class="route.name == 'shopDetail' && 'mt-5 pt-4'">
            <Loader class="mt-5 pt-4" />
        </MDBRow>
    </MDBContainer>
</template>

<script setup>
import ShopPhotos from "./shop-detail-components/ShopPhotos.vue";
import ShopDetails from "./shop-detail-components/ShopDetails.vue";
import Loader from "../loaders/MyShopLoader.vue";
import { ref, watchEffect } from "@vue/runtime-core";
import { useStore } from "vuex";
import { useRouter, useRoute } from "vue-router";
import { getUserBusiness } from "../../api";
import { useCookies } from "vue3-cookies";

const store = useStore();
const router = useRouter();
const route = useRoute();
const { cookies } = useCookies();
const loading = ref(true);
const apiResponse = ref(null);
const isVerified = ref('inactive');

// Get Business for provider without business id
const getProviderBusiness = () => {
    getUserBusiness().then(({ data }) => {
        // console.log(data)
        apiResponse.value = data;
        loading.value = false;
        isVerified.value = data.data.status;
        console.log(isVerified.value)
        if (!data.data) {
            let user = cookies.get("user");
            user.is_shop = false;
            cookies.set("user", user);
            store.dispatch("setAuth");
        }
    });
};

// Get Business for client with business id so that user can see the data of specific shop
const getShopForClient = () => {
    if (route.params.id) {
        getUserBusiness(route.params.id).then(({ data }) => {
            apiResponse.value = data;
            loading.value = false;
            if (data.data === null) {
                router.push("/booking-list");
            }
        });
    }
};

watchEffect(() => {
    if (store.state.auth) {
        if (store.state.role === "Provider" && !store.state.shop) {
            router.push("/add-shop");
        } else if (
            store.state.role === "Provider" &&
            store.state.shop &&
            route.name === "myShop"
        ) {
            getProviderBusiness();
        } else if (
            store.state.role === "Provider" &&
            route.name === "shopDetail"
        ) {
            router.push("/my-shop");
        } else if (
            store.state.role === "Client" &&
            (route.name === "myShop" || route.name === "addShop")
        ) {
            router.push("/");
        } else if (
            store.state.role === "Client" &&
            route.name == "shopDetail"
        ) {
            getShopForClient();
        }
    } else {
        router.push("/login");
    }
});
</script>
<style scoped>
.edit-btn {
    padding: 0.65rem 2rem;
}
</style>
