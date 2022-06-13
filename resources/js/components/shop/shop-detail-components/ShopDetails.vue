<template>
  <div class="shop-detials pe-5">
    <div class="d-flex align-items-start justify-content-between">
      <div class="left">
        <h3 class="heading-color fw-bold">{{ props.data.name }}</h3>
        <div class="d-flex align-items-center stars">
          <em class="fa fa-star me-2"></em>
          <em class="fa fa-star me-2"></em>
          <em class="fa fa-star me-2"></em>
          <em class="fa fa-star me-2"></em>
          <em class="fa fa-star me-2"></em>

          <span class="rating ms-3">5.0(122)</span>
        </div>
        <div class="d-flex align-items-center mt-1">
          <svg
            width="14"
            height="19"
            viewBox="0 0 14 19"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M7 18.0035C5.73694 16.9261 4.56619 15.745 3.5 14.4725C1.9 12.5615 8.78894e-07 9.71551 8.78894e-07 7.00351C-0.00069302 5.61847 0.409509 4.26436 1.17869 3.11254C1.94788 1.96072 3.04147 1.06297 4.32107 0.532908C5.60067 0.00284672 7.00875 -0.1357 8.36712 0.134802C9.72548 0.405303 10.9731 1.07269 11.952 2.05251C12.6038 2.70137 13.1203 3.47305 13.4719 4.32288C13.8234 5.17272 14.0029 6.08384 14 7.00351C14 9.71551 12.1 12.5615 10.5 14.4725C9.4338 15.745 8.26306 16.9261 7 18.0035ZM7 2.00351C5.67441 2.0051 4.40356 2.53239 3.46622 3.46973C2.52888 4.40707 2.00159 5.67792 2 7.00351C2 8.16951 2.527 10.1885 5.035 13.1895C5.65313 13.9276 6.30901 14.6332 7 15.3035C7.69102 14.6339 8.34721 13.9293 8.966 13.1925C11.473 10.1875 12 8.16851 12 7.00351C11.9984 5.67792 11.4711 4.40707 10.5338 3.46973C9.59644 2.53239 8.3256 2.0051 7 2.00351ZM7 10.0035C6.20435 10.0035 5.44129 9.68744 4.87868 9.12483C4.31607 8.56222 4 7.79916 4 7.00351C4 6.20786 4.31607 5.4448 4.87868 4.88219C5.44129 4.31958 6.20435 4.00351 7 4.00351C7.79565 4.00351 8.55871 4.31958 9.12132 4.88219C9.68393 5.4448 10 6.20786 10 7.00351C10 7.79916 9.68393 8.56222 9.12132 9.12483C8.55871 9.68744 7.79565 10.0035 7 10.0035Z"
              fill="#B7B7B7"
            />
          </svg>
          <small class="ms-2 location">{{ props.data.address }}</small>
        </div>
      </div>
      <div class="right ms-4 flex-shrink-0" v-if="role == 'Client'">
        <div class="select-parent position-relative">
          <input
            type="date"
            v-model="booking_date"
            class="form-control select-date"
            readonly
          />
        </div>
        <div
          class="
            est-time
            fw-500
            mt-1
            text-orange
            small
            d-flex
            align-items-center
            justify-content-end
          "
        >
          <small> Estimated time </small>
          <small class="fw-normal text-color-1 d-flex align-items-center">
            <svg
              class="mx-2"
              width="11"
              height="11"
              viewBox="0 0 16 16"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M8 0C3.58214 0 0 3.58214 0 8C0 12.4179 3.58214 16 8 16C12.4179 16 16 12.4179 16 8C16 3.58214 12.4179 0 8 0ZM8 14.6429C4.33214 14.6429 1.35714 11.6679 1.35714 8C1.35714 4.33214 4.33214 1.35714 8 1.35714C11.6679 1.35714 14.6429 4.33214 14.6429 8C14.6429 11.6679 11.6679 14.6429 8 14.6429Z"
                fill="#B7B7B7"
              />
              <path
                d="M11.1198 10.2609L8.57335 8.4198V4.00016C8.57335 3.92159 8.50907 3.8573 8.4305 3.8573H7.57157C7.493 3.8573 7.42871 3.92159 7.42871 4.00016V8.91801C7.42871 8.96444 7.45014 9.0073 7.48764 9.03409L10.4412 11.1877C10.5055 11.2341 10.5948 11.2198 10.6412 11.1573L11.1519 10.4609C11.1984 10.3948 11.1841 10.3055 11.1198 10.2609Z"
                fill="#B7B7B7"
              />
            </svg>
            2h 30 mints
          </small>
        </div>
      </div>
    </div>
    <p class="desc mt-3 small">
      {{ props.data.description }}
    </p>

    <div class="categories mt-4 mb-5">
      <h6 class="fw-bold heading-color mb-0">Categories</h6>
      <div class="category-tabs" v-if="props.data.user_categories.length">
        <MDBTabs v-model="activeTabId4" vertical>
          <MDBTabNav tabsClasses="my-3">
            <MDBTabItem
              class="
                fw-bold
                mb-3
                py-2
                px-0
                text-capitalize
                d-flex
                align-items-end
              "
              v-for="(category, index) in props.data.user_categories"
              :key="index"
              :wrap="false"
              :tabId="`category-${category.id}`"
              :href="`category-${category.id}`"
              >{{ category.category.name }}
            </MDBTabItem>
          </MDBTabNav>
          <MDBTabContent>
            <MDBTabPane
              class="category-tab-pane"
              :tabId="`category-${category.id}`"
              v-for="(category, index) in categtoriesArray"
              :key="index"
            >
              <div v-if="category.user_business_category_services.length">
                <div
                  class="
                    d-flex
                    align-items-center
                    justify-content-between
                    border-bottom
                    py-3
                  "
                  v-for="(
                    subcategory, index
                  ) in category.user_business_category_services"
                  :key="index"
                >
                  <small
                    ><span v-if="role == 'Client'"
                      ><label
                        :for="'service-' + subcategory.user_service.id"
                        class="custom-label"
                      >
                        <input
                          type="checkbox"
                          class="me-2"
                          :checked="handleCheckbox(subcategory.id)"
                          :id="'service-' + subcategory.user_service.id"
                          @change="setCategories($event, subcategory)"
                        />

                        <span class="checkmark"></span> </label
                    ></span>
                    {{ subcategory.user_service.name }}
                    <svg
                      v-if="role === 'Client' && subcategory.type === 'shop'"
                      class="ms-2"
                      width="15"
                      height="15"
                      viewBox="0 0 20 20"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M0.999787 11.0002H1.99979V18.0002C1.99979 19.1032 2.89679 20.0002 3.99979 20.0002H15.9998C17.1028 20.0002 17.9998 19.1032 17.9998 18.0002V11.0002H18.9998C19.1975 11.0002 19.3908 10.9415 19.5552 10.8316C19.7197 10.7217 19.8478 10.5656 19.9235 10.3829C19.9991 10.2002 20.0189 9.99912 19.9804 9.80517C19.9418 9.61122 19.8466 9.43305 19.7068 9.2932L10.7068 0.293201C10.614 0.200255 10.5038 0.126518 10.3825 0.0762068C10.2612 0.0258961 10.1311 0 9.99979 0C9.86845 0 9.73841 0.0258961 9.61709 0.0762068C9.49578 0.126518 9.38558 0.200255 9.29279 0.293201L0.292787 9.2932C0.152977 9.43305 0.057771 9.61122 0.0192035 9.80517C-0.0193641 9.99912 0.000438951 10.2002 0.076109 10.3829C0.151779 10.5656 0.279918 10.7217 0.444328 10.8316C0.608738 10.9415 0.802037 11.0002 0.999787 11.0002ZM7.99979 18.0002V13.0002H11.9998V18.0002H7.99979ZM9.99979 2.4142L15.9998 8.4142V13.0002L16.0008 18.0002H13.9998V13.0002C13.9998 11.8972 13.1028 11.0002 11.9998 11.0002H7.99979C6.89679 11.0002 5.99979 11.8972 5.99979 13.0002V18.0002H3.99979V8.4142L9.99979 2.4142Z"
                        fill="#8C96A2"
                      />
                    </svg>
                  </small>
                  <small class="text-orange fw-bold price"
                    >{{ subcategory.charges + " $" }}
                  </small>
                </div>
              </div>
              <div class="py-5 text-center text-orange" v-else>
                No services for this category
              </div>
            </MDBTabPane>
          </MDBTabContent>
        </MDBTabs>
      </div>
      <div class="py-5" v-else>
        <h4 class="text-orange fw-500">No categoies found</h4>
      </div>
      <div class="text-end mt-4" v-if="role == 'Client'">
        <router-link
          :to="{
            name: 'payment',
            params: {
              data: JSON.stringify({
                user_business_id: route.params.id,
                booking_date,
                items: selectedCategories.map((item) => {
                  return JSON.stringify({
                    name: item.user_service.name,
                    id: item.id,
                    price: item.charges,
                  });
                }),
              }),
            },
          }"
          :style="selectedCategories.length === 0 && { pointerEvents: 'none' }"
        >
          <MDBBtn
            :disabled="selectedCategories.length === 0"
            class="
              text-white
              bg-orange
              fw-500
              text-capitalize
              rounded-4
              shadow-0
              book-btn
            "
          >
            Book now
          </MDBBtn>
        </router-link>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from "@vue/reactivity";
import { computed, onMounted, watchEffect } from "@vue/runtime-core";
import {
  MDBTabs,
  MDBTabNav,
  MDBTabContent,
  MDBTabItem,
  MDBTabPane,
} from "mdb-vue-ui-kit";
import { useStore } from "vuex";
import { MDBInput } from "mdb-vue-ui-kit";
import { useRoute } from "vue-router";

const props = defineProps({
  data: Object,
});

const categtoriesArray = ref(props.data.user_categories);
const route = useRoute();
const store = useStore();
const todayDate = computed(() => {
  let date = new Date();
  return date.toISOString().split("T")[0];
});

const booking_date = ref(todayDate.value);

const role = ref(store.state.role);
const selectedCategories = ref([]);

const activeTabId4 = ref(
  `category-${
    props.data.user_categories.length && props.data.user_categories[0].id
  }`
);

const setCategories = (event, val) => {
  if (event.target.checked) {
    selectedCategories.value.push(val);
  } else {
    let index = selectedCategories.value.findIndex(
      (item) => item.id === val.id
    );
    selectedCategories.value.splice(index, 1);
  }
};

watchEffect(() => {
  // Setting items in selectedCategories from localStorage
  let categoriesInLocalStorage = localStorage.getItem("data");
  if (categoriesInLocalStorage) {
    let array = JSON.parse(JSON.parse(categoriesInLocalStorage).items);

    categtoriesArray.value.map((item) => {
      if (item.user_business_category_services.length) {
        item.user_business_category_services.map((service) => {
          array.map((category) => {
            if (service.id === category.id) {
              selectedCategories.value.push(service);
            }
          });
        });
      }
    });
  }
});

const handleCheckbox = (id) => {
  let categoriesInLocalStorage = localStorage.getItem("data");
  if (categoriesInLocalStorage) {
    let array = JSON.parse(JSON.parse(categoriesInLocalStorage).items);
    for (let i = 0; i < array.length; i++) {
      if (array[i].id === id) {
        return true;
      }
    }
  }
};
</script>

<style scoped>
.rating {
  color: #616161;
}
.stars em {
  color: #f2c94c;
}
.location {
  color: #b7b7b7;
}
.desc {
  color: #7c7c7c;
}
.price {
  background-color: #fff4f0;
  padding: 0.2rem 0rem;
  width: 100px;
  border-radius: 20px;
  text-align: center;
}
.book-btn {
  padding: 0.7rem 2.4rem;
  font-size: 0.75rem;
}
</style>