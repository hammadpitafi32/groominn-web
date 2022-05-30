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
      :position="m.position"
      :clickable="true"
      :draggable="true"
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
    position: {
      lat: 51.093048,
      lng: 6.84212,
    },
  },
]);
</script>