<template>
  <div
    id="shop-images-sliders"
    class="carousel slide"
    data-bs-ride="carousel"
  >
    <div class="carousel-indicators">
      <button v-for="(shop_img, index) in images"
        :key="index"
        type="button"
        data-bs-target="#shop-images-sliders"
        :data-bs-slide-to="index"
        :class="index == 0 && 'active'"
      >
        <img :src="shop_img" class="img-fluid d-block" alt="">
      </button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item" v-for="(shop_img, index) in images" :key="index" :class="index == 0 && 'active'">
        <img :src="shop_img" class="d-block w-100" alt="..." />
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from "@vue/reactivity";
import img from "../../../assets/img/shop-img.jpg";

const images = ref([img, img, img, img, img, img, img]);
</script>

<style scoped>
#shop-images-sliders button {
    height: 80px;
    width: 80px;
    background: none;
    margin-inline: .5rem;
}
#shop-images-sliders button:not(.active){
  opacity: .5;
}
#shop-images-sliders button img{
border-radius: 10px;

}
.carousel-indicators{
    top: 105%;
    flex-wrap: wrap;
    margin: auto;
}
</style>
