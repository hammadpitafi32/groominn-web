<template>
  <GoogleMap
    key="AIzaSyBea65xicuAhWz8oVHvEn6_Rlg8h9nr_EU"
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