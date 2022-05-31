<template>
  <div class="bg-white shadow-6-strong p-3 rounded-5 filter-box">
    <div class="d-flex align-items-center">
      <select
        name="sort"
        id=""
        v-model="sort"
        class="form-select me-3 fw-bold rounded-5"
      >
        <option value="all">All</option>
        <option value="star-1">1 Star</option>
        <option value="star-2">2 Star</option>
        <option value="star-3">3 Star</option>
        <option value="star-4">4 Star</option>
        <option value="star-5">5 Star</option>
      </select>

      <select
        name="category"
        id="category"
        v-model="category"
        class="form-select border-0 me-4"
      >
        <option value="">Category</option>
        <option
          v-for="category in categoriesFromAdmin"
          :key="category.id"
          :value="category.id"
        >
          {{ category.name }}
        </option>
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
import { computed } from "@vue/runtime-core";
import { useRouter } from "vue-router";
import { useStore } from "vuex";
import NoAuthModal from "../modals/NoAuthModal.vue";

const router = useRouter();
const store = useStore();

const sort = ref("all");
const category = ref("");
const modalShow = ref(false);

const categoriesFromAdmin = computed(() => store.state.allCategories);

const paramsHandle = () => {
  if (store.state.auth) {
    const queries = {};
    router.push({
      path: "/booking-list",
      query: {
        ...(location.value && { location: location.value }),
        ...(category.value && { category: category.value }),
      },
    });
  } else {
    router.push("/register");
  }
};
</script>