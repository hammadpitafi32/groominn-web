<template>
    <div class="notifiction-panel position-absolute">
        <div class="heading p-4 border-bottom">
            <h4 class="fw-bold mb-0">Notifcations</h4>
        </div>
        <div v-if='loading' class="notification-list">
            <div v-for='notify in notifications' @click='openNotification(notify.id)' class="notifi p-3 d-flex align-items-center border-bottom">
                <div class="user-img pe-2">
                    <img :src="notificationsAvatar(notify.from_user.avatar_path)" style="width:50px !important;" class="img-fluid rounded-circle" alt="" />
                </div>
                <div class="user-data">
                    <div>
                        <span class="fw-500">{{notify.from_user.name}} </span>
                        <span><span class="text-color-1"></span> <span class="text-light-blue">{{notify.data}}</span></span>
                    </div>
                    <small class="time text-light-blue">{{ dateFormat(notify.created_at)}}</small>
                </div>
                <div class="ms-auto">
                    <span v-if='notify.seen' class="active-icon-plus"></span>
                    <span v-else class="active-icon"></span>
                </div>
            </div>
          
        </div>
        <div v-else class="notification-list">
          <div class="alert alert-info" role="alert">
            No Notifications!
          </div>
        </div>
    </div>
    <div class="overlay" @click="emits('close')"></div>
</template>
<script setup>
import { ref } from "@vue/reactivity";
import { watchEffect } from "@vue/runtime-core";
import { getNotifications, seenNotification } from "../api";
import { useStore } from "vuex";
import { useToast } from "vue-toastification";
import moment from 'moment';
import { useRoute, useRouter } from "vue-router";

const store = useStore();
const emits = defineEmits(['close']);
const notifications = ref([]);
const loading = ref(false);
// const route = useRoute();
const router = useRouter();

watchEffect(() => {
  getNotifications().then(({ data }) => {

    notifications.value = data.data;
    
    loading.value = true;
  });
});
const notificationsAvatar = (path) => {
  
   return 'storage/' +path;
};
const dateFormat =(date)=> {
    return moment(date.created_at).fromNow()
};

const openNotification=(id)=>{
  const formData = new FormData(); 
  formData.append("id", id);
  
  seenNotification(formData).then(({ data }) => {

    if(data.data.type=='BOOKING'){
        if(store.state.role === "Provider"){
            router.push({ path: '/bookings' })
            return
        }
        router.push({ path: '/booking-detail' })
      
    }

  });
};

</script>
<style scoped>
.text-light-blue {
    color: #4BAEEA;
}

.active-icon {
    background-color: #4BAEEA;
    height: 15px;
    width: 15px;
    border-radius: 50%;
    display: block;
}
.active-icon-plus{
    background-color: #e3d8d8;
    height: 15px;
    width: 15px;
    border-radius: 50%;
    display: block;
}

.overlay {
    position: fixed;
    inset: 0;
    z-index: 1;
    background-color: rgba(0, 0, 0, .5);
}
.notifi{
  cursor: pointer;
}

</style>
