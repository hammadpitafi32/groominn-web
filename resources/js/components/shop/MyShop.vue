<template>
  <MDBContainer>
    <MDBRow class="mt-5 pt-4">
      <MDBCol col="5">
        <ShopPhotos />
      </MDBCol>
      <MDBCol col="7">
        <ShopDetails />
      </MDBCol>
    </MDBRow>
  </MDBContainer>
</template>

<script setup>
import ShopPhotos from "./shop-detail-components/ShopPhotos.vue";
import ShopDetails from "./shop-detail-components/ShopDetails.vue";
</script>