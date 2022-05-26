<template>
  <MDBModal
    id="exampleModalCenter"
    tabindex="-1"
    labelledby="exampleModalCenterTitle"
    v-model="exampleModalCenter"
    centered
    staticBackdrop
  >
    <MDBModalBody class="p-4">
      <div class="py-4 text-center">
        <h4 class="fw-bold mt-3">Do you want to delete this {{props.data.label == 'category' ? 'category' : 'service'}} ?</h4>
        <small v-if="props.data.label == 'category'">
            <b class="text-orange">Note:</b> All services will also be deleted against this category.
        </small>
      </div>
      <div class="d-flex align-items-center justify-content-between mt-4">
        <MDBBtn
          class="ok-btn text-capitalize shadow-0 border"
          @click="
            (exampleModalCenter = false),
              (props.data.id = ''),
              (props.data.label = '')
          "
        >
          Cancel
        </MDBBtn>
        <MDBBtn
          class="bg-orange text-white ok-btn text-capitalize"
          @click="handleDelete()"
        >
          Ok
        </MDBBtn>
      </div>
    </MDBModalBody>
  </MDBModal>
</template>


<script setup>
import { ref } from "@vue/reactivity";
import { watchEffect } from "@vue/runtime-core";
import { MDBModal, MDBModalBody } from "mdb-vue-ui-kit";
import { emit } from "process";
import { useToast } from "vue-toastification";
import { deleteUserCategory, deleteUserService } from "../../api";

const exampleModalCenter = ref(false);
const toast = useToast();

const props = defineProps({
  data: Object,
});

const emits = defineEmits(["getData"]);

watchEffect(() => {
  if (props.data.id) {
    exampleModalCenter.value = true;
  }
});

const setData = (response) => {
  exampleModalCenter.value = false;
  toast.success(response.data.message);
  emits("getData");
};

const handleDelete = () => {
  if (props.data.label == "category") {
    deleteUserCategory(props.data.id).then((res) => {
      setData(res);
    });
  } else if (props.data.label == "service") {
    deleteUserService(props.data.id).then((res) => {
      setData(res);
    });
  }
};
</script>

<style scoped>
.ok-btn {
  padding: 0.3rem 2rem;
}
</style>