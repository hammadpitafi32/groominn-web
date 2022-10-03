<template>
  <GoogleMap
    api-key="AIzaSyDoWPQ82mh0PFBOYhhHCK924wOffWOFSdc"
    style="width: 100%; height: calc(100vh - 120px)"
    :center="center"
    :zoom="props.activeShop ? 18 : 15"
  >
    <Marker
      v-for="(marker, index) in markers"
      :key="index"
      :options="{ position: marker.coords }"
    >
      <InfoWindow>
        <div id="contet">
          <div id="siteNotice"></div>
          <MDBRow class="mx-0">
            <MDBCol col="5" class="pe-0">
              <img
                :src="
                  marker.data.images.length
                    ? asset.baseUrl + marker.data.images[0].name
                    : 'http://127.0.0.1:8000/images/no-img.webp?2a1649c3403bc7fe3caf888a0bf327e6'
                "
                alt="shop-img"
                class="img-fluid shop-img"
              />
            </MDBCol>
            <MDBCol col="7">
              <h6 class="shop-title fw-bold" :title="marker.data.title">
                {{ marker.data.title }}
              </h6>
              <small
                :title="marker.data.address"
                class="d-block text-color-1 shop-title"
                >{{ marker.data.address }}</small
              >
              <p class="shop-desc text-dark mt-2">
                {{ marker.data.description }}
              </p>
              <div class="mt-3 text-end">
                <router-link :to="`/shop-detail/${marker.data.id}`">
                  <MDBBtn
                    class="
                      bg-orange
                      text-white
                      rounded-5
                      shadow-0
                      text-capitalize
                      fw-normal
                      booknow-btn
                    "
                    size="sm"
                    >Book now</MDBBtn
                  >
                </router-link>
              </div>
            </MDBCol>
          </MDBRow>
        </div>
      </InfoWindow></Marker
    >
  </GoogleMap>
</template>

<script setup>
import { computed, ref, watchEffect } from "@vue/runtime-core";
import { GoogleMap, Marker, InfoWindow } from "vue3-google-map";
import { useGeolocation } from "../../get-location/getLocation";
import { asset } from "../../../baseURL";

const { coords } = useGeolocation();
const props = defineProps({
  data: Array,
  activeShop: Object,
});

const markers = ref(null);

const center = computed(() => ({
  lat: props.activeShop?.lat ?? coords.value.latitude,
  lng: props.activeShop?.lng ?? coords.value.longitude,
}));

watchEffect(() => {
  if (props.data && props.data.length) {
    let coordinates = props.data.map((shop) => {
      return {
        coords: {
          lat: shop.latitude,
          lng: shop.longitude,
        },
        data: {
          images: shop.user_business_images,
          title: shop.name,
          description: shop.description,
          address: shop.address,
          id: shop.id,
        },
      };
    });
    // console.log(coordinates);
    markers.value = coordinates;
  }
});
</script>

<style scoped>
.shop-img {
  max-width: 100% !important;
  min-height: 100%;
  max-height: 100px;
  object-fit: cover;
  border-radius: 12px;
}
.shop-title {
  white-space: nowrap;
  text-overflow: ellipsis;
  overflow: hidden;
}
.shop-desc {
  text-overflow: ellipsis;
  overflow: hidden;
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
}
.booknow-btn {
  font-size: 0.6rem;
}
</style>