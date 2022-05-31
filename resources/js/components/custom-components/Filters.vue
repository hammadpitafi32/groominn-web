<template>
  <div class="bg-white shadow-6-strong p-3 rounded-5 filter-box">
    <div class="d-flex align-items-center">
      <select
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
          :value="category.name"
        >
          {{ category.name }}
        </option>
      </select>

      <MDBBtn
        class="text-white bg-orange w-25"
        :disabled="!sort && !category"
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

const sort = ref("");
const category = ref("");
const modalShow = ref(false);

const categoriesFromAdmin = computed(() => store.state.allCategories);

const paramsHandle = () => {
  if (store.state.auth) {
    const queries = {};
    router.push({
      path: "/booking-list",
      query: {
        ...(sort.value && { rating: sort.value }),
        ...(category.value && { category: category.value.toLowerCase() }),
      },
    });
  } else {
    router.push("/register");
  }
};
</script>