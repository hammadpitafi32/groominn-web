<template>
  <MDBRow>
    <MDBCol col="5">
      <div class="skelton skelton-5 w-100"></div>
    </MDBCol>
    <MDBCol col="7 pe-5">
      <div class="detail-skelton">
        <h1 class="skelton"></h1>
        <div class="skelton stars mb-2"></div>
        <div class="skelton location"></div>
        <p class="skelton mt-4"></p>
        <div class="skelton categories"></div>
      </div>
    </MDBCol>
  </MDBRow>
</template>


<style scoped>
.skelton-5 {
  height: 450px;
}
.detail-skelton {
  height: 500px;
}
h1.skelton {
  height: 37px;
}
.stars{
  height: 25px;
  max-width: 250px;
}
.location{
  max-width: 300px;
  height: 30px;
}
p.skelton{
  height: 100px;
}
.categories{
  height: 200px;
}
</style>