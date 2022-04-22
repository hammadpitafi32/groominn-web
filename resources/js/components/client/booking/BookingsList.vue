<template>
    <div class="mt-5 pt-5">
        <div class="container">
            <div class="row">
                <div class="col-5">
                    <div class="booking-list-filters mb-3">
                        <form action="">
                            <div class="d-flex">
                                <select name="location" id="" v-model="location" class="form-select me-3 fw-bold rounded-5">
                                    <option value="">Location</option>
                                    <option value="location-1">Location 1</option>
                                    <option value="location-2">Location 2</option>
                                    <option value="location-3">Location 3</option>
                                </select>
                                <select name="date" id="" v-model="date" class="form-select me-3 fw-bold rounded-5">
                                    <option value="">Date</option>
                                    <option value="date-1">Date 1</option>
                                    <option value="date-2">Date 2</option>
                                    <option value="date-3">Date 3</option>
                                </select>
                                <select name="category" id="" v-model="category" class="form-select me-3 fw-bold rounded-5">
                                    <option value="">Category</option>
                                    <option value="category-1">Category 1</option>
                                    <option value="category-2">Category 2</option>
                                    <option value="category-3">Category 3</option>
                                </select>
                                <MDBBtn class="bg-orange text-white rounded-5 shadow-4-strong fw-bold flex-shrink-0 text-capitalize">
                                    <span class="mx-3">Search</span>
                                </MDBBtn>
                            </div>
                        </form>
                    </div>
                    <div class="booking-profiles">
                        <div v-for="(booking , index) in bookingList" :key="index" :class="booking.id === activeId && 'active shadow-4-strong'" class="booking-pro mb-3 rounded-5 border p-3" @click="activeBooking(booking)">
                            <div class="row">
                                <div class="col-5">
                                    <img :src="booking.img" class="img-fluid rounded-5 booking-img" alt="">
                                </div>
                                <div class="col-7">
                                    <h5 class="fw-bold mb-0">{{booking.title}}</h5>
                                    <small v-if="booking.id === activeId" class="text-light-color ms-3">{{booking.address}}</small>
                                    <p class="mt-2 text-color-1 small">{{booking.descrip}}</p>
                                    <div class="mt-3">
                                        <span class="d-block fw-500 categories">Categories</span>
                                        <div class="d-flex flex-wrap mt-3">
                                            <div class="booking-category me-2"></div>
                                            <div class="booking-category me-2"></div>
                                            <div class="booking-category me-2"></div>
                                            <div class="booking-category me-2"></div>
                                            <div class="booking-category me-2"></div>
                                        </div>
                                        <div class="text-end mt-2">
                                            <MDBBtn class="btn bg-orange text-white shadow-0 rounded-5 text-capitalize booking-btn" :disabled="booking.id !== activeId">Book Now</MDBBtn>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-7">
                    <Map />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from "@vue/reactivity";
import { watchEffect } from "@vue/runtime-core";
import { useRoute, useRouter } from "vue-router";
import store from "../../../store";
import Map from "./Map.vue";

const activeId = ref(1);
const router = useRouter();
const route = useRoute();
const location = ref('');
const category = ref('');
const date = ref('');

const bookingList = ref([
    {
        id: 1,
        title: 'Grooming life style',
        img: '../images/shop-img.png',
        address: 'Albert street, New York , usa',
        descrip: 'and training programs. We pride ourselves on being your one stop shop',
    },
    {
        id: 2,
        title: 'Grooming life style',
        img: '../images/shop-img.png',
        address: 'Albert street, New York , usa',
        descrip: 'and training programs. We pride ourselves on being your one stop shop',
    },
    {
        id: 3,
        title: 'Grooming life style',
        img: '../images/shop-img.png',
        address: 'Albert street, New York , usa',
        descrip: 'and training programs. We pride ourselves on being your one stop shop',
    },
    {
        id: 4,
        title: 'Grooming life style',
        img: '../images/shop-img.png',
        address: 'Albert street, New York , usa',
        descrip: 'and training programs. We pride ourselves on being your one stop shop',
    },
]);

const activeBooking = (booking) => {
    activeId.value = booking.id;
}


watchEffect(() => {
   store.dispatch('clientRedirection')
   if(route.query.location){
       location.value = route.query.location
   }
   if(route.query.category){
       category.value = route.query.category
   }
})

</script>

<style scoped>
.text-light-color{
    color: #B4B4B4;
    font-size: .8rem;
}
.categories{
    color: #676767;
}
.booking-img{
    height: 100%;
    object-fit: cover;
}
</style>
