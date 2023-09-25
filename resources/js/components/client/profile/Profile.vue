<template>
    <MDBContainer class="mt-5 pt-5">
        <MDBRow>
            <form action="">
                <MDBCol col="12 col-sm-10" class="mx-auto mt-5">
                    <!-- <h6 class="fw-bold mb-0 ms-2">Profile</h6> -->
                    <div class="user-profile p-3">
                        <!-- <div class="d-flex align-items-center"> -->
                        <div class="row">
                          
                            <div class="col-md-12">
                                
                                <div class="card">
                                    <div class="card-header">
                                        Edit User Profile
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <div class="col-md-12" style="text-align:center;">
                                                <img width="120" v-if="avatar!=''" style="border-radius: 20%;" :src="avatar" alt="profile Image">
                                                <img width="120" v-else style="border-radius: 20%;" src="images/avatar.png" alt="profile Image">
                                            </div>
                                        </div>
                                        <MDBCol col="12 col-sm-6 col-md-3 ">
                                            <div class="mb-2 fw-bold small">
                                                Upload Photo (Optional)
                                            </div>
                                            <div class="col-md-6">
                                                <input type="file" id="avatar" @change="uploadPics($event, 'profile')"  name="avatar" class="form-control ">

                                            </div>
     
                                        </MDBCol>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- </div> -->
                        <MDBRow>
                            <MDBCol col="12">
                                <div class="py-3 px-4 rounded-5 bg-light-grey shop-form mt-4">
                                    <!-- <form action=""> -->
                                    <div class="form-gruop mb-3">
                                        <label for="" class="fw-bold mb-2">First Name</label>
                                        <MDBInput class="py-2" :class="errors && errors.first_name &&'border-danger'" v-model="firstName" />
                                        <span v-if="errors && errors.first_name" class="text-danger small">{{ errors.first_name[0] }}</span>
                                    </div>
                                    <div class="form-gruop mb-3">
                                        <label for="" class="fw-bold mb-2">Last Name</label>
                                        <MDBInput class="py-2" :class="errors && errors.last_name &&'border-danger'" v-model="lastName" />
                                        <span v-if="errors && errors.last_name" class="text-danger small">{{ errors.last_name[0] }}</span>
                                    </div>
                                    <div class="form-gruop mb-3">
                                        <label for="" class="fw-bold mb-2">Phone Number</label>
                                        <MDBInput type="text" class="py-2" :class="errors && errors.phone &&'border-danger'" v-model="phoneNumber" />
                                        <span v-if="errors && errors.phone" class="text-danger small">{{ errors.phone[0] }}</span>
                                    </div>
                                    <div class="form-gruop mb-3">
                                        <label for="" class="fw-bold mb-2">Email</label>
                                        <MDBInput type="email" class="py-2" :class="errors && errors.email &&'border-danger'" v-model="email" />
                                        <span v-if="errors && errors.email" class="text-danger small">{{ errors.email[0] }}</span>
                                    </div>
                                    <div class="form-gruop mb-3">
                                        <label for="" class="fw-bold mb-2">Current Password</label>
                                        <MDBInput type="password" class="py-2" :class="errors && errors.current_password &&'border-danger'" v-model="currentPassword" />
                                        <span v-if="errors && errors.current_password" class="text-danger small">{{ errors.current_password[0] }}</span>
                                    </div>
                                    <div class="form-gruop mb-3">
                                        <label for="" class="fw-bold mb-2">New Password</label>
                                        <MDBInput type="password" class="py-2" :class="errors && errors.password &&'border-danger'" v-model="newPassword" />
                                        <span v-if="errors && errors.password" class="text-danger small">{{ errors.password[0] }}</span>
                                    </div>
                                    <div class="form-gruop mb-3">
                                        <label for="" class="fw-bold mb-2">Confirm New Password</label>
                                        <MDBInput type="password" class="py-2" :class="errors && errors.confirm_password &&'border-danger'" v-model="confirmNewPassword" />
                                        <span v-if="errors && errors.confirm_password" class="text-danger small">{{ errors.confirm_password[0] }}</span>
                                    </div>
                                    <div class="text-end pt-3">
                                        <MDBBtn @click="saveUserHandler()" class="bg-orange text-white text-capitalize">Save Changes</MDBBtn>
                                    </div>
                                    <!-- </form> -->
                                </div>
                            </MDBCol>
                        </MDBRow>
                    </div>
                </MDBCol>
            </form>
        </MDBRow>
    </MDBContainer>
    <!-- <Footer /> -->
</template>
<script setup>
// import Footer from "../../../layout/Footer.vue";
import { ref, watchEffect, watch } from "@vue/runtime-core";
import { MDBInput } from "mdb-vue-ui-kit";
import { useStore } from "vuex";
import { useToast } from "vue-toastification";
import { reactive } from "@vue/reactivity";

import {
    getUserData,
    saveUserData,
} from "../../../api";

const store = useStore();

const toast = useToast();


// const dragOnProfileImg = ref(false);

const drag = reactive({
    profile: false,

});

const firstName = ref("");
const lastName = ref("");
const email = ref("");
const avatar = ref("");
const phoneNumber = ref("");
const currentPassword = ref("");
const newPassword = ref("");
const confirmNewPassword = ref("");
const user_detail = ref(null);
const avatar_path = ref("");
const avatarForApi = ref("");

const errors = ref(null);

const convertUrlToFile = async (url) => {
    let response = await fetch(url);
    let data = await response.blob();
    return new File([data], "image.jpg", {
        type: data.type,
    });
};
const dragHandlner = (event) => {
    event.preventDefault();
    event.stopPropagation();
    // console.log(event);
};
const uploadPics = (event, val, firstTimeSet) => {
    let array = [];
    firstTimeSet && array.push(event);
    const files = firstTimeSet ? array : event.target.files;
    const fileReader = new FileReader();
    
    fileReader.addEventListener("load", () => {
        // console.log(files[0])
  
            avatarForApi.value=files[0];
       
    });
    fileReader.readAsDataURL(files[0]);
};
watch(avatar_path, () => {
    if (!avatar_path.value) {
        avatarForApi.value = avatar_path.value;
    }
});

watchEffect(() => {
    // store.dispatch("clientRedirection");
});
getUserData().then(({ data }) => {
    user_detail.value = data.data;
    
    if (user_detail.value) {
        avatar.value = 'storage/' + user_detail.value.avatar_path;
        
        firstName.value = user_detail.value.first_name;
        if (user_detail.value.last_name) {

            lastName.value = user_detail.value.last_name;
        }
        phoneNumber.value = user_detail.value.user_detail.phone;
        email.value = user_detail.value.email;
    }
});
const saveUserHandler = () => {
    const formData = new FormData();
    if (user_detail.value) {
        formData.append("id", user_detail.value.id);
    }
    formData.append("first_name", firstName.value);
    formData.append("last_name", lastName.value);
    formData.append("phone", phoneNumber.value);
    formData.append("email", email.value);
    formData.append("current_password", currentPassword.value);
    formData.append("password", newPassword.value);
    formData.append("password_confirmation", confirmNewPassword.value);
    formData.append("avatar_path", avatarForApi.value);

    saveUserData(formData)
        .then((response) => {
            errors.value = null;
            if (response.data.success == true) {
                user_detail.value = response.data.data;
            }
            toast.success("Changes Saved Successfully!");

            setTimeout(function() {
                location.reload();
            }, 2000); // 3000 milliseconds = 3 seconds
        })
        .catch((err) => {
            errors.value = err.response.data.errors;
        });
};

</script>
