<template>
  <div class="notifiction-panel position-absolute">
    <div class="heading p-4 border-bottom">
      <h4 class="fw-bold mb-0">Notifcations</h4>
    </div>
    <div class="notification-list">
      <div class="notifi p-3 d-flex align-items-center border-bottom">
        <div class="user-img pe-2">
          <img
            src="../assets/img/notify-img.png"
            class="img-fluid rounded-circle"
            alt=""
          />
        </div>
        <div class="user-data">
          <div>
            <span class="fw-500">Juliette Sweetz </span>
            <span
              ><span class="text-color-1">booked a new</span> <span class="text-light-blue">"Booking"</span></span
            >
          </div>
          <small class="time text-light-blue">46 minute ago</small>
        </div>
        <div class="ms-auto">
            <span class="active-icon"></span>
        </div>
      </div>
       <div class="notifi p-3 d-flex align-items-center border-bottom">
        <div class="user-img pe-2">
          <img
            src="../assets/img/notify-img.png"
            class="img-fluid rounded-circle"
            alt=""
          />
        </div>
        <div class="user-data">
          <div>
            <span class="fw-500">Juliette Sweetz </span>
            <span
              ><span class="text-color-1">booked a new</span> <span class="text-light-blue">"Booking"</span></span
            >
          </div>
          <small class="time text-light-blue">46 minute ago</small>
        </div>
        <div class="ms-auto">
            <span class="active-icon"></span>
        </div>
      </div>
    </div>
  </div>

  <div class="overlay" @click="emits('close')"></div>
</template>

<script setup>

const emits = defineEmits(['close']);

</script>

<style scoped>

.text-light-blue{
    color: #4BAEEA;
}
.active-icon{
    background-color: #4BAEEA;
    height: 15px;
    width: 15px;
    border-radius: 50%;
    display: block;
}
.overlay{
    position: fixed;
    inset: 0;
    z-index: 1;
    background-color: rgba(0, 0, 0, .5);
}

</style>