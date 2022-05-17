<template>
  <GoogleMap
    api-key="AIzaSyA7NJiportPdMrSes7VW1XI63-qhL0i3DM"
    style="width: 100%; height: calc(100vh - 120px)"
    :center="center"
    :zoom="15"
  >
    <Marker :options="{ position: center }" />
  </GoogleMap>
</template>

<script setup>
import { computed} from "@vue/runtime-core";
import { GoogleMap, Marker } from "vue3-google-map";
import { useGeolocation } from "../../get-location/getLocation";

const { coords } = useGeolocation();

const center = computed(() => ({
  lat: coords.value.latitude,
  lng: coords.value.longitude,
}));
</script>