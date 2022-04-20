<template>
  <div class="shop-detials pe-5">
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
    <p class="desc mt-3 small">
      {{ props.data.description }}
    </p>

    <div class="categories mt-4 mb-5" v-if="props.data.user_categories.length">
      <h6 class="fw-bold heading-color mb-0">Categories</h6>
      <div class="category-tabs">
        <MDBTabs v-model="activeTabId4" vertical>
          <MDBTabNav tabsClasses="my-3">
            <MDBTabItem
              class="fw-bold mb-3 py-2 px-0 text-capitalize"
              v-for="(category, index) in props.data.user_categories"
              :key="index"
              :wrap="false"
              :tabId="`category-${category.id}`"
              :href="`category-${category.id}`"
              >{{ category.name }}</MDBTabItem
            >
          </MDBTabNav>
          <MDBTabContent>
            <MDBTabPane
              class="category-tab-pane"
              :tabId="`category-${category.id}`"
              v-for="(category, index) in props.data.user_categories"
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
                  <small>{{ subcategory.user_service.name }}</small>
                  <small class="text-orange fw-bold price">{{
                    subcategory.charges + " $"
                  }}</small>
                </div>
              </div>
              <div class="py-5 text-center text-orange" v-else>
                No services for this category
              </div>
            </MDBTabPane>
          </MDBTabContent>
        </MDBTabs>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from "@vue/reactivity";
import {
  MDBTabs,
  MDBTabNav,
  MDBTabContent,
  MDBTabItem,
  MDBTabPane,
} from "mdb-vue-ui-kit";

const props = defineProps({
  data: Object,
});

const activeTabId4 = ref(`category-${props.data.user_categories.length && props.data.user_categories[0].id}`);
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
</style>