<template>
  <div class="bg-white shadow-6-strong p-3 rounded-5 filter-box">
    <div class="d-flex align-items-center">
      <select
        name="location"
        id="location"
        v-model="location"
        class="form-select border-0 me-4"
      >
        <option value="">Location</option>
        <option value="location-1">Location 1</option>
        <option value="location-2">Location 2</option>
        <option value="location-3">Location 3</option>
      </select>

      <select
        name="category"
        id="category"
        v-model="category"
        class="form-select border-0 me-4"
      >
        <option value="">Category</option>
        <option value="category-1">Category 1</option>
        <option value="category-2">Category 2</option>
        <option value="category-3">Category 3</option>
      </select>

      <MDBBtn
        class="text-white bg-orange w-25"
        :disabled="!location && !category"
        @click="paramsHandle()"
        >Search</MDBBtn
      >
    </div>
  </div>
  <NoAuthModal :show="modalShow" @closeModal="modalShow = false" />
</template>

<script setup>
import { ref } from "@vue/reactivity";
import { useRouter } from "vue-router";
import { useStore } from "vuex";
import NoAuthModal from "../modals/NoAuthModal.vue";

const router = useRouter();
const store = useStore();

const location = ref("");
const category = ref("");
const modalShow = ref(false);

const paramsHandle = () => {

  if (store.state.auth) {
    const queries = {
        
    }
    router.push({
      path: "/booking-list",
      query: {
        ...(location.value && {location: location.value}),
        ...(category.value && {category: category.value})
      },
    });
  } else {
      modalShow.value = true
  }
};
</script>