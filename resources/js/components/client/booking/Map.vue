<template>
  <!-- <GoogleMap
    api-key="AIzaSyA7NJiportPdMrSes7VW1XI63-qhL0i3DM"
    style="width: 100%; height: calc(100vh - 120px)"
    :center="center"
    :zoom="15"
  >
    <Marker :options="{ position: center }" />
  </GoogleMap> -->
  <GMapMap
    :center="center"
    :zoom="12"
    style="width: 100%; height: calc(100vh - 120px)"
  >
    <GMapMarker
      :key="index"
      v-for="(m, index) in markers"
      :position="m"
      :clickable="true"
      :icon="{
        url: '../../../assets/img/marker.png',
        scaledSize: { height: 50 },
        labelOrigin: { x: 16, y: -10 },
      }"
    />
  </GMapMap>
</template>

<script setup>
import { computed, ref, watchEffect } from "@vue/runtime-core";
import { GoogleMap, Marker } from "vue3-google-map";
import { useGeolocation } from "../../get-location/getLocation";

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
        lat: shop.latitude,
        lng: shop.longitude,
      };
    });
    markers.value = coordinates;
  }
});
</script>