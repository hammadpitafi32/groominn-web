<template>
  <div class="bg-white shadow-6-strong p-3 rounded-5 filter-box">
    <div class="d-flex align-items-center">
      <GMapAutocomplete class="form-select border-0 me-7" style='background:#efefef' id="googleAutoComplete" placeholder="Search services in your area" @place_changed="setPlace" />
<!--       <select
        name="sort"
        id=""
        v-model="sort"
        class="form-select border-0 me-3"
      >
        <option value="">Sorting</option>
        <option value="all">All</option>
        <option value="star-1">1 Star</option>
        <option value="star-2">2 Star</option>
        <option value="star-3">3 Star</option>
        <option value="star-4">4 Star</option>
        <option value="star-5">5 Star</option>
      </select> -->

<!--       <select
        name="category"
        id="category"
        v-model="category"
        class="form-select border-0 me-4"
      >
        <option value="">Category</option>
        <option
          v-for="category in categoriesFromAdmin"
          :key="category.id"
          :value="category.name"
        >
          {{ category.name }}
        </option>
      </select> -->

      <MDBBtn
        style='margin-top: 10px;'
        class="text-white bg-orange w-25"
        :disabled="!address.place"
        @click="paramsHandle()"
        >Search</MDBBtn
      >
    </div>
  </div>
  <NoAuthModal :show="modalShow" @closeModal="modalShow = false" />
</template>

<script setup>
import { reactive, ref } from "@vue/reactivity";
import { computed } from "@vue/runtime-core";
import { useRouter } from "vue-router";
import { useStore } from "vuex";
import NoAuthModal from "../modals/NoAuthModal.vue";

const router = useRouter();
const store = useStore();

const sort = ref("");
const category = ref("");
const modalShow = ref(false);
const address = reactive({
    place: "",
    lat: "",
    lng: "",
});
const categoriesFromAdmin = computed(() => store.state.allCategories);

const setPlace = (data) => {
    address.lat = data.geometry.location.lat();
    address.lng = data.geometry.location.lng();
    address.place = data.formatted_address;
};
const paramsHandle = () => {
  // console.log(address.place)
  if (store.state.auth) {
    const queries = {};
    router.push({
      path: "/booking-list",
      query: {
        ...(address.place && { latitude: address.lat,longitude:address.lng }),
        // ...(sort.value && { rating: sort.value }),
        // ...(category.value && { category: category.value.toLowerCase() }),
      },
    });
  } else {
    router.push("/register");
  }
};
</script>