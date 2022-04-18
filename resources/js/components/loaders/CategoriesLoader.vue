<template>
    <div class="d-flex align-items-center justify-content-between my-5 border-bottom pb-5" v-for="n in 5" :key="n" style="height: 30px">
        <span class="skelton title d-block"></span>
        <span class="skelton buttons d-block"></span>
    </div>
</template>


<style scoped>
.title{
    height: 30px;
    width: 120px;
}
.buttons{
    height: 30px;
    width: 80px;
}
</style>