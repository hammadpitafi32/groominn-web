<template>
  <MDBContainer>
    <MDBRow>
      <MDBCol col="12">
        <div class="d-flex align-items-center justify-content-between px-5">
          <h6 class="text-orange fw-bold mb-0 fs-custom">My Services</h6>
          <MDBBtn
            @click="addBtnHandler()"
            class="
              bg-orange
              text-white
              f-w-400
              text-capitalize
              rounded-4
              shadow-0
              fs-custom
            "
            >Add New Services</MDBBtn
          >
        </div>
        <div class="p-5 pt-3">
          <div class="p-5 rounded-5 bg-light-grey">
            <h6 class="f-w-400 mb-4 px-3">
              <span class="p-2 shadow-1-strong me-2 rounded-2">
                <svg
                  width="24"
                  height="20"
                  viewBox="0 0 24 20"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M2.75137 0.667962H20.8615C21.278 0.667962 21.6162 1.00124 21.6162 1.41178V11.8229C21.6162 12.2334 21.278 12.5667 20.8615 12.5667H2.75137C2.33479 12.5667 1.99661 12.2334 1.99661 11.8229V1.41178C1.99661 1.00124 2.33479 0.667962 2.75137 0.667962ZM20.107 2.15526H3.50579V11.0794H20.107V2.15526Z"
                    fill="#F05922"
                  />
                  <path
                    d="M1.24328 11.0775H22.3717C22.7883 11.0775 23.1265 11.4104 23.1265 11.8209V14.7955C23.1265 15.2061 22.7883 15.5394 22.3717 15.5394H1.24328C0.826694 15.5394 0.488522 15.2061 0.488522 14.7955V11.8209C0.488522 11.4104 0.826694 11.0775 1.24328 11.0775ZM21.6173 12.5648H1.99769V14.0521H21.6173V12.5648Z"
                    fill="#F05922"
                  />
                  <path
                    d="M10.3012 14.054H13.3196C14.5676 14.054 15.5835 15.0549 15.5835 16.2848C15.5835 17.5151 14.5676 18.5159 13.3196 18.5159H10.3012C9.05319 18.5159 8.03728 17.5151 8.03728 16.2848C8.03728 15.0549 9.05319 14.054 10.3012 14.054ZM13.3196 17.0286C13.7361 17.0286 14.0743 16.6947 14.0743 16.2848C14.0743 15.8753 13.7361 15.5413 13.3196 15.5413H10.3012C9.88463 15.5413 9.54646 15.8753 9.54646 16.2848C9.54646 16.6947 9.88463 17.0286 10.3012 17.0286H13.3196Z"
                    fill="#F05922"
                  />
                  <path
                    d="M2.75023 14.0511H10.0802C10.4968 14.0511 10.835 14.384 10.835 14.7946C10.835 15.1643 10.5593 15.4996 10.1883 15.5524C9.81388 15.6051 9.54133 15.9125 9.54133 16.2819C9.54133 16.5937 9.74583 16.8739 10.0501 16.9787C10.2764 17.057 10.4522 17.2361 10.5223 17.4621C10.5935 17.6882 10.5503 17.9336 10.4077 18.1239C9.8802 18.8245 8.63286 20.0003 6.19932 20.0003C5.23489 20.0003 4.36856 19.7191 3.6245 19.1646C2.60446 18.4037 1.99547 17.1656 1.99547 15.853V14.7946C1.99547 14.384 2.33364 14.0511 2.75023 14.0511ZM10.0802 14.8164H10.0726H10.0802ZM8.16446 15.5384H3.50464V15.853C3.50464 16.703 3.88945 17.4972 4.5354 17.9782C5.01174 18.3329 5.57168 18.513 6.19932 18.513C7.36756 18.513 8.14166 18.1658 8.63597 17.793C8.25703 17.39 8.03216 16.8545 8.03216 16.2819C8.03216 16.0225 8.07914 15.7719 8.16446 15.5384Z"
                    fill="#F05922"
                  />
                  <path
                    d="M13.5315 14.0511H20.8615C21.278 14.0511 21.6162 14.384 21.6162 14.7946V15.853C21.6162 17.1663 21.0072 18.4037 19.9872 19.1646C19.2421 19.7191 18.3761 20.0003 17.4117 20.0003C14.9781 20.0003 13.7308 18.8245 13.204 18.1232C13.0613 17.9336 13.0182 17.6882 13.0893 17.4614C13.1601 17.2354 13.3353 17.056 13.5615 16.978C13.8659 16.8739 14.0703 16.5937 14.0703 16.2819C14.0703 15.9125 13.7978 15.6051 13.4234 15.5524C13.0524 15.4996 12.7767 15.1857 12.7767 14.8164C12.7767 14.4058 13.1142 14.0511 13.5315 14.0511ZM20.107 15.5384H15.4472C15.5325 15.7719 15.5795 16.0225 15.5795 16.2819C15.5795 16.8545 15.3546 17.39 14.975 17.793C15.4693 18.1658 16.2434 18.513 17.4117 18.513C18.0393 18.513 18.5992 18.3329 19.0763 17.9775C19.7222 17.4972 20.107 16.7023 20.107 15.853V15.5384Z"
                    fill="#F05922"
                  />
                  <path
                    d="M9.53999 0.667962H14.0679C14.4841 0.667962 14.8223 1.00124 14.8223 1.41178V11.8229C14.8223 12.2334 14.4841 12.5667 14.0679 12.5667H9.53999C9.12375 12.5667 8.78557 12.2334 8.78557 11.8229V1.41178C8.78557 1.00124 9.12375 0.667962 9.53999 0.667962ZM13.3131 2.15526H10.2947V11.0794H13.3131V2.15526Z"
                    fill="#F05922"
                  />
                </svg>
              </span>
              My Services
            </h6>

            <div v-if="!loading">
              <MDBTable class="service-table" v-if="services.length > 0">
                <thead>
                  <tr>
                    <th scope="col">Categories</th>
                    <th scope="col">Services</th>
                    <th scope="col">Charges</th>
                    <th scope="col">Duration (hh:mm:ss)</th>
                    <th scope="col">Type</th>
                    <th scope="col">Edit</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(service, index) in services" :key="index">
                    <td>{{ service.user_category.category.name }}</td>
                    <td>{{ service.user_service.name }}</td>
                    <td>{{ service.charges + ' $' }}</td>
                    <td>{{ service.duration }}</td>
                    <td>{{ service.type }}</td>
                    <td>
                      <a
                        href="javascript:void(0)"
                        class="text-orange me-3"
                        @click="editService(service)"
                      >
                        <svg
                          width="20"
                          height="20"
                          viewBox="0 0 24 24"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            d="M4.371 19.2C4.431 19.2 4.491 19.194 4.551 19.185L9.597 18.3C9.657 18.288 9.714 18.261 9.756 18.216L22.473 5.499C22.5008 5.47125 22.5229 5.43828 22.5379 5.40199C22.553 5.3657 22.5607 5.32679 22.5607 5.2875C22.5607 5.24821 22.553 5.2093 22.5379 5.17301C22.5229 5.13672 22.5008 5.10375 22.473 5.076L17.487 0.087C17.43 0.03 17.355 0 17.274 0C17.193 0 17.118 0.03 17.061 0.087L4.344 12.804C4.299 12.849 4.272 12.903 4.26 12.963L3.375 18.009C3.34582 18.1697 3.35624 18.3351 3.40538 18.4909C3.45452 18.6467 3.54088 18.7881 3.657 18.903C3.855 19.095 4.104 19.2 4.371 19.2ZM6.393 13.968L17.274 3.09L19.473 5.289L8.592 16.167L5.925 16.638L6.393 13.968ZM23.04 21.72H0.96C0.429 21.72 0 22.149 0 22.68V23.76C0 23.892 0.108 24 0.24 24H23.76C23.892 24 24 23.892 24 23.76V22.68C24 22.149 23.571 21.72 23.04 21.72Z"
                            fill="#F05922"
                          />
                        </svg>
                      </a>
                      <a href="javascript:void(0)" class="text-orange" @click="deleteService(service.id)">
                        <svg
                          width="15"
                          height="18"
                          viewBox="0 0 20 23"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            d="M13.9583 2.07H14.1667C14.0521 2.07 13.9583 1.9665 13.9583 1.84V2.07H6.04167V1.84C6.04167 1.9665 5.94792 2.07 5.83333 2.07H6.04167V4.14H4.16667V1.84C4.16667 0.825125 4.91406 0 5.83333 0H14.1667C15.0859 0 15.8333 0.825125 15.8333 1.84V4.14H13.9583V2.07ZM0.833334 4.14H19.1667C19.6276 4.14 20 4.55113 20 5.06V5.98C20 6.1065 19.9063 6.21 19.7917 6.21H18.2188L17.5755 21.2463C17.5339 22.2266 16.7995 23 15.9115 23H4.08854C3.19792 23 2.46615 22.2295 2.42448 21.2463L1.78125 6.21H0.208334C0.09375 6.21 0 6.1065 0 5.98V5.06C0 4.55113 0.372396 4.14 0.833334 4.14ZM4.28906 20.93H15.7109L16.3411 6.21H3.65886L4.28906 20.93Z"
                            fill="#FF0000"
                          />
                        </svg>
                      </a>
                    </td>
                  </tr>
                </tbody>
              </MDBTable>

              <div
                class="text-center fs-5 fw-500 mt-4 pt-4 text-orange border-top"
                v-else
              >
                No Servcies Found
              </div>
            </div>
            <ServicesLoader v-else />
          </div>
        </div>
      </MDBCol>
    </MDBRow>
  </MDBContainer>

  <!-- Add new Service modal -->
  <MDBModal
    id="add-new-category-modal"
    tabindex="-1"
    v-model="AddNewServiceModal"
    centered
    scrollable
    class="modal-width"
  >
    <MDBModalHeader
      class="justify-content-center border-0 p-4 pb-3"
      :close="false"
    >
      <MDBModalTitle class="fw-bold fs-4">
        {{ editMode ? "Update" : "Add" }} Service
      </MDBModalTitle>
    </MDBModalHeader>
    <MDBModalBody class="p-5 pt-3">
      <div class="custom-height">
        <form>
          <div class="mb-3">
            <label for="add-cat" class="small mb-2">Category</label>
            <select
              id="add-cat"
              :disabled="!categoryOptions"
              v-model="category"
              :class="errors && errors.category_id && 'border-danger'"
              class="small category-input form-select text-capitalize"
            >
              <option value="">Select Category</option>
              <option
                class="text-capitalize"
                v-for="option in categoryOptions"
                :key="option.id"
                :value="option.id"
              >
                {{ option.category.name }}
              </option>
            </select>
            <span
              class="text-danger small"
              v-if="errors && errors.category_id"
              >{{ errors.category_id[0] }}</span
            >
          </div>
          <div class="mb-3">
            <label for="add-service" class="small mb-2">Service </label>
            <MDBInput
              id="add-service"
              type="text"
              class="small category-input"
              placeholder="Service"
              :class="errors && errors.name && 'border-danger'"
              v-model="serviceInput"
            />
            <span class="text-danger small" v-if="errors && errors.name">{{
              errors.name[0]
            }}</span>
          </div>
          <div class="row">
            <div class="col-6">
              <label for="add-duration" class="small mb-2">Duration </label>
              <vue-timepicker
                class="time-picker"
                input-width="100%"
                :class="errors && errors.duration && 'border-danger'"
                v-model="duration"
              ></vue-timepicker>
              <span
                class="text-danger small"
                v-if="errors && errors.duration"
                >{{ errors.duration[0] }}</span
              >
            </div>
            <div class="col-6">
              <label for="add-charges" class="small mb-2">Charges </label>
              <MDBInput
                id="add-charges"
                type="text"
                class="small category-input"
                placeholder="Charges"
                :class="errors && errors.charges && 'border-danger'"
                v-model="charges"
              />
              <span class="text-danger small" v-if="errors && errors.charges">{{
                errors.charges[0]
              }}</span>
            </div>
          </div>
          <div class="mt-4">
            <MDBRadio
              label="Home service"
              labelClass="text-dull me-4"
              class="type-radio"
              value="home"
              v-model="type"
              inline
              name="inlineRadioOptions"
            />
            <MDBRadio
              label="Saloon service"
              class="type-radio"
              value="shop"
              labelClass="text-dull"
              v-model="type"
              inline
              name="inlineRadioOptions"
            />
          </div>
        </form>
      </div>
      <div class="text-end mt-3">
        <MDBBtn
          @click="addNewServiceHandler()"
          class="bg-orange text-white rounded-4 fw-bold ok-btn shadow-0"
          >Ok</MDBBtn
        >
      </div>
    </MDBModalBody>
  </MDBModal>

  <!-- Delete Confirmation modal -->

  <ConfirmationModal @getData="getServices" :data="deletedService" />

</template>

<script setup>
import { reactive, ref } from "@vue/reactivity";
import {
  MDBModal,
  MDBModalHeader,
  MDBModalTitle,
  MDBModalBody,
  MDBInput,
  MDBTable,
  MDBRadio,
} from "mdb-vue-ui-kit";
import {
  createUserService,
  getUserCategories,
  getUserServices,
} from "../../../api";
import VueTimepicker from "vue3-timepicker/src/VueTimepicker.vue";
import ServicesLoader from "../../loaders/ServicesLoader.vue";
import ConfirmationModal from "../../modals/ConfirmationModal.vue";
import { watchEffect } from "@vue/runtime-core";
import { useStore } from "vuex";
import { useRouter } from "vue-router";
import { useToast } from "vue-toastification";

const store = useStore();
const router = useRouter();
const toast = useToast();

const services = ref([]);
const loading = ref(true);
const editMode = ref(false);
const AddNewServiceModal = ref(false);
const categoryOptions = ref(null);
const pagination = reactive({
  value: false,
});
const deletedService = reactive({
  id: '',
  label: ''
})

const category = ref("");
const serviceInput = ref("");
const duration = ref("");
const charges = ref("");
const type = ref("home");
const serviceId = ref(null);

const errors = ref(null);

const getServices = () => {
  getUserServices().then((res) => {
    services.value = res.data.data.data;
    loading.value = false;
  });
};

watchEffect(() => {
  if (store.state.auth) {
    getServices();
    if (store.state.role === "Provider" && !store.state.shop) {
      router.push("/add-shop");
    } else if (store.state.role === "Client") {
      router.push("/");
    }
  } else {
    router.push("/login");
  }
});

const editService = (service) => {
  editMode.value = true;
  AddNewServiceModal.value = true;
  getUserCategories(pagination).then((res) => {
    categoryOptions.value = res.data.data;
  });
  category.value = service.user_category.id;
  serviceInput.value = service.user_service.name
  charges.value = service.charges
  duration.value = service.duration
  serviceId.value = service.id
  type.value = service.type
};

const addNewServiceHandler = () => {
  const formData = new FormData();

  formData.append("category_id", category.value);
  formData.append("service", serviceInput.value);
  formData.append("duration", duration.value);
  formData.append("charges", charges.value);
  formData.append("type", type.value);

  if(serviceId.value){
    formData.append('id', serviceId.value);
  }

  createUserService(formData)
    .then(() => {
      errors.value = null;
      toast.success(`Service has been ${editMode.value ? 'Updated' : 'Added'} successfully`);
      AddNewServiceModal.value = false;
      getServices();
    })
    .catch((err) => {
      errors.value = err.response.data.errors;
    });
};

const addBtnHandler = () => {
  AddNewServiceModal.value = true;
  editMode.value = false;
  category.value = '';
  serviceInput.value = ''
  charges.value = ''
  duration.value = ''
  serviceId.value = null
  getUserCategories(pagination).then((res) => {
    categoryOptions.value = res.data.data;
  });
};

const deleteService = (id) => {
  deletedService.id = id;
  deletedService.label = 'service';
}

</script>

<style scoped>
.fs-custom {
  font-size: 0.84rem;
}
.ok-btn {
  padding: 0.3rem 2rem;
}
td{
  text-transform: capitalize;
}
</style>