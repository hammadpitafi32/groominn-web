<template>
  <MDBModal
    id="exampleModalCenter"
    tabindex="-1"
    labelledby="exampleModalCenterTitle"
    v-model="noAuthModal"
    centered
    staticBackdrop
  >
    <MDBModalBody class="p-4">
      <div class="py-4 text-center">
        <h4 class="fw-bold mb-5 mt-3">
          You are not login, Please login to booking
        </h4>
      </div>
      <div class="d-flex align-items-center justify-content-between">
        <MDBBtn
          class="ok-btn text-capitalize shadow-0 border"
          @click="emits('closeModal')"
        >
          Cancel
        </MDBBtn>
        <MDBBtn
          class="bg-orange text-white ok-btn text-capitalize"
          @click="router.push('/login'), noAuthModal = false;"
        >
          Login
        </MDBBtn>
      </div>
    </MDBModalBody>
  </MDBModal>
</template>

<script setup>
import { ref } from "@vue/reactivity";
import { watch } from "@vue/runtime-core";
import { MDBModal, MDBModalBody } from "mdb-vue-ui-kit";
import { useRouter } from "vue-router";

const router = useRouter();
const props = defineProps({
    show: Boolean
})

const emits = defineEmits(['closeModal']);

const noAuthModal = ref(false);

watch(props, () => {
    if(props.show){
        noAuthModal.value = true;
    } else {
        noAuthModal.value = false;
    }
})
</script>
