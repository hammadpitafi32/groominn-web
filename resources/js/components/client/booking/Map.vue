<template>
  <GoogleMap
    api-key="AIzaSyA7NJiportPdMrSes7VW1XI63-qhL0i3DM"
    style="width: 100%; height: calc(100vh - 120px)"
    :center="center"
    :zoom="15"
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
            <MDBCol col="5">
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
          </MDBRow>
        </div> </InfoWindow
    ></Marker>
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
});

const markers = ref(null);

const center = computed(() => ({
  lat: coords.value.latitude,
  lng: coords.value.longitude,
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
        },
      };
    });
    console.log(coordinates);
    markers.value = coordinates;
  }
});
</script>

<style scoped>
.shop-img {
  max-width: 100% !important;
}
/* #contet {
  padding-inline: 15px;
} */
</style>