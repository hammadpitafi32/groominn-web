<template>
  <div class="mt-5 pt-5">
    <div class="container">
      <div class="row">
        <div class="col-5">
          <div class="booking-list-filters mb-3">
            <form action="">
              <div class="d-flex">
                <select
                  name="sort"
                  id=""
                  v-model="sort"
                  class="form-select me-3 fw-bold rounded-5"
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
                  id=""
                  v-model="category"
                  class="form-select me-3 fw-bold rounded-5"
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
                  class="
                    bg-orange
                    text-white
                    rounded-5
                    shadow-4-strong
                    fw-bold
                    flex-shrink-0
                    text-capitalize
                  "
                >
                  <span class="mx-3">Search</span>
                </MDBBtn>
              </div>
            </form>
          </div>
          <div class="booking-profiles">
            <div v-if="!loading">
              <div v-if="bookingList.length">
                <div
                  v-for="(booking, index) in bookingList"
                  :key="index"
                  :class="booking.id === activeId && 'active shadow-4-strong'"
                  class="booking-pro mb-3 rounded-5 border p-3"
                  @click="activeBooking(booking)"
                >
                  <div class="row">
                    <div class="col-5">
                      <img
                        :src="
                          booking.user_business_images.length > 0
                            ? imgUrl + booking.user_business_images[0].name
                            : 'http://127.0.0.1:8000/images/no-img.webp?2a1649c3403bc7fe3caf888a0bf327e6'
                        "
                        class="img-fluid rounded-5 booking-img"
                        alt=""
                      />
                    </div>
                    <div class="col-7">
                      <h5 class="fw-bold mb-0">{{ booking.name }}</h5>
                      <small
                        v-if="booking.id === activeId"
                        class="text-light-color address"
                        >{{ booking.address }}</small
                      >
                      <p class="mt-2 text-color-1 small description">
                        {{ booking.description }}
                      </p>
                      <div class="mt-3">
                        <span class="d-block fw-500 categories"
                          >Categories</span
                        >
                        <div class="d-flex flex-wrap mt-3">
                          <div
                            class="
                              booking-category
                              me-2
                              d-flex
                              align-items-center
                              justify-content-center
                              fw-500
                            "
                            :title="category.name"
                            v-for="category in booking.user_categories"
                            :key="category.id"
                          >
                            {{ category.category.name.charAt(0) }}
                          </div>
                        </div>
                        <div class="text-end mt-2">
                          <router-link
                            :to="`/shop-detail/${booking.id}`"
                            :style="
                              booking.id !== activeId && {
                                pointerEvents: 'none',
                              }
                            "
                          >
                            <MDBBtn
                              class="
                                btn
                                bg-orange
                                text-white
                                shadow-0
                                rounded-5
                                text-capitalize
                                booking-btn
                              "
                              :disabled="booking.id !== activeId"
                              >Book Now</MDBBtn
                            >
                          </router-link>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div
                class="text-orange text-center fw-bold fs-5 mt-5 pt-5"
                style="direction: ltr"
                v-else
              >
                <h3 class="fw-bold">NO Match Found!</h3>
                <!-- Currently no shops are available in your area -->
              </div>
            </div>
            <ShopsLoader v-else />
          </div>
        </div>
        <div class="col-7">
          <Map :data="bookingList" :activeShop="activeShop" />
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from "@vue/reactivity";
import { computed, watchEffect } from "@vue/runtime-core";
import { useRoute, useRouter } from "vue-router";
import { getAllShops } from "../../../api";
import store from "../../../store";
import Map from "./Map.vue";
import ShopsLoader from "../../loaders/ShopsLoader.vue";
import { asset } from "../../../baseURL";

const imgUrl = asset.baseUrl;

const activeId = ref(null);
const router = useRouter();
const route = useRoute();
const sort = ref("");
const category = ref("");
const loading = ref(true);

const bookingList = ref(null);

const categoriesFromAdmin = computed(() => store.state.allCategories);
const activeShop = ref(null);

const activeBooking = (booking) => {
  activeId.value = booking.id;
  activeShop.value = {
    lat: booking.latitude,
    lng: booking.longitude,
  };
};

getAllShops().then(({ data }) => {
  bookingList.value = data.data.data;
  // if (data.data.data.length) {
  //   activeId.value = bookingList.value[0].id;
  // }
  loading.value = false;
});

watchEffect(() => {
  store.dispatch("clientRedirection");
  if (route.query.category) {
    if (categoriesFromAdmin.value) {
      categoriesFromAdmin.value.map((item) => {
        let smallCategory = item.name.toLowerCase();
        if (smallCategory == route.query.category) {
          category.value = item.id;
        }
      });
    }
  }

  if (route.query.rating) {
    sort.value = route.query.rating;
  }

  localStorage.clear();
});
</script>

<style scoped>
.text-light-color {
  color: #b4b4b4;
  font-size: 0.8rem;
}
.categories {
  color: #676767;
}
.booking-img {
  height: 100%;
  object-fit: cover;
}
.address,
.description {
  display: -webkit-box;
  overflow: hidden;
  text-overflow: ellipsis;
  -webkit-box-orient: vertical;
  -webkit-line-clamp: 1;
}
.description {
  -webkit-line-clamp: 2;
}

select,
option {
  text-transform: capitalize;
}
</style>
