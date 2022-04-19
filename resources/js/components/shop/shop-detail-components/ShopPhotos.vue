<template>
  <div
    id="shop-images-sliders"
    class="carousel slide"
    data-bs-ride="carousel"
    v-if="images.length"
  >
    <div class="carousel-indicators">
      <button v-for="(shop_img, index) in images"
        :key="index"
        type="button"
        data-bs-target="#shop-images-sliders"
        :data-bs-slide-to="index"
        :class="index == 0 && 'active'"
      >
        <img :src="url + shop_img.name" class="img-fluid d-block" alt="">
      </button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item" v-for="(shop_img, index) in images" :key="index" :class="index == 0 && 'active'">
        <img :src="url + shop_img.name" class="d-block w-100" alt="..." />
      </div>
    </div>
  </div>

  <div v-else class="no-image">
    <img src="../../../assets/img/no-img.webp" class="img-fluid" alt="">
  </div>
</template>

<script setup>
import { ref } from "@vue/reactivity";
import { asset } from '../../../baseURL';

const props = defineProps({
  photos: Array
})

const images = ref(props.photos);

const url = ref(asset.baseUrl);

console.log(url.value );

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
