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
    :zoom="15"
    style="width: 100%; height: calc(100vh - 120px)"
  >
    <GMapMarker
      :key="index"
      v-for="(m, index) in markers"
      :position="m.coords"
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
import { computed, ref } from "@vue/runtime-core";
import { GoogleMap, Marker } from "vue3-google-map";
import { useGeolocation } from "../../get-location/getLocation";

const { coords } = useGeolocation();

const center = computed(() => ({
  lat: coords.value.latitude,
  lng: coords.value.longitude,
}));

const markers = ref([
  {
    coords: {
      lat: 33.5407694,
      lng: 73.075933,
    },
  },
]);
</script>