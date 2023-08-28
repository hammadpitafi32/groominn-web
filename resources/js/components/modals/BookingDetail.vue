<template>
    <MDBModal id="booking-detail" tabindex="-1" v-model="props.bookingModal" centered scrollable class="modal-width" staticBackdrop>
        <button @click="emit('closeModal')" type="button" class="btn-close" aria-label="Close"></button>
        <MDBModalHeader class="justify-content-center border-0 p-4 pb-3" :close="false">
            <MDBModalTitle class="fw-bold fs-4">Booking Detail </MDBModalTitle>
        </MDBModalHeader>
        <MDBModalBody class="p-5 pt-3">
            <MDBTable class="booking-detials-table">
                <tbody>
                    <tr>
                        <td class="fw-bold">Name:</td>
                        <td>{{ props.data.user.name }}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Phone no:</td>
                        <td>{{ props.data.user.user_detail.phone }}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Address:</td>
                        <td>
                            <svg width="12" height="17" viewBox="0 0 14 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7 18.0035C5.73694 16.9261 4.56619 15.745 3.5 14.4725C1.9 12.5615 8.78894e-07 9.71551 8.78894e-07 7.00351C-0.00069302 5.61847 0.409509 4.26436 1.17869 3.11254C1.94788 1.96072 3.04147 1.06297 4.32107 0.532908C5.60067 0.00284672 7.00875 -0.1357 8.36712 0.134802C9.72548 0.405303 10.9731 1.07269 11.952 2.05251C12.6038 2.70137 13.1203 3.47305 13.4719 4.32288C13.8234 5.17272 14.0029 6.08384 14 7.00351C14 9.71551 12.1 12.5615 10.5 14.4725C9.4338 15.745 8.26306 16.9261 7 18.0035ZM7 2.00351C5.67441 2.0051 4.40356 2.53239 3.46622 3.46973C2.52888 4.40707 2.00159 5.67792 2 7.00351C2 8.16951 2.527 10.1885 5.035 13.1895C5.65313 13.9276 6.30901 14.6332 7 15.3035C7.69102 14.6339 8.34721 13.9293 8.966 13.1925C11.473 10.1875 12 8.16851 12 7.00351C11.9984 5.67792 11.4711 4.40707 10.5338 3.46973C9.59644 2.53239 8.3256 2.0051 7 2.00351ZM7 10.0035C6.20435 10.0035 5.44129 9.68744 4.87868 9.12483C4.31607 8.56222 4 7.79916 4 7.00351C4 6.20786 4.31607 5.4448 4.87868 4.88219C5.44129 4.31958 6.20435 4.00351 7 4.00351C7.79565 4.00351 8.55871 4.31958 9.12132 4.88219C9.68393 5.4448 10 6.20786 10 7.00351C10 7.79916 9.68393 8.56222 9.12132 9.12483C8.55871 9.68744 7.79565 10.0035 7 10.0035Z" fill="#B7B7B7" />
                            </svg>
                            {{ address }}
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Services:</td>
                        <td>{{services.join(', ')}}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Charges:</td>
                        <td>{{props.data.charges}} Rs</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Estimated time:</td>
                        <td class="d-flex align-items-center">
                            <svg class="me-1" width="12" height="12" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8 0C3.58214 0 0 3.58214 0 8C0 12.4179 3.58214 16 8 16C12.4179 16 16 12.4179 16 8C16 3.58214 12.4179 0 8 0ZM8 14.6429C4.33214 14.6429 1.35714 11.6679 1.35714 8C1.35714 4.33214 4.33214 1.35714 8 1.35714C11.6679 1.35714 14.6429 4.33214 14.6429 8C14.6429 11.6679 11.6679 14.6429 8 14.6429Z" fill="#6B6A6A" />
                                <path d="M11.1198 10.2609L8.57335 8.4198V4.00016C8.57335 3.92159 8.50907 3.8573 8.4305 3.8573H7.57157C7.493 3.8573 7.42871 3.92159 7.42871 4.00016V8.91801C7.42871 8.96444 7.45014 9.0073 7.48764 9.03409L10.4412 11.1877C10.5055 11.2341 10.5948 11.2198 10.6412 11.1573L11.1519 10.4609C11.1984 10.3948 11.1841 10.3055 11.1198 10.2609Z" fill="#6B6A6A" />
                            </svg>
                            {{
                            setEstimatedTime(props.data.estimated_time)
                            }}
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Status:</td>
                        <td v-if='props.data.status=="droped"'><span style="color:red">Droped</span></td>
                        <td v-if='props.data.status=="pending"'><span style="color:blue">Pending</span></td>
                        <td v-if='props.data.status=="completed"'><span style="color:green">Completed</span></td>
                         <td v-if='props.data.status=="rejected"'><span style="color:orange">Rejected</span></td>
                        <td v-if='props.data.status=="accepted"'><span style="color:green">Accepted</span></td>
                        <td v-if='props.data.status=="cancel"'><span style="color:gray">Cancelled</span></td>
                    </tr>
                </tbody>
            </MDBTable>
            <div v-if='props.data.status !="pending"' class="text-end mt-3">
                <MDBBtn  @click="emit('closeModal')" class="bg-orange text-white rounded-4 fw-bold ok-btn shadow-0">Ok</MDBBtn>

            </div>
            <div v-if='props.data.status =="pending"' class="d-flex align-items-center justify-content-between mt-4">

                <button type="button" @click='rejectBooking(props.data.id)' class="ok-btn text-capitalize shadow-0 border" >Reject</button>
                
                <button  type="button" @click="acceptBooking(props.data.id)" class="bg-orange text-white ok-btn text-capitalize">Accept</button>
            </div>
        </MDBModalBody>
    </MDBModal>
</template>
<script setup>
import moment from 'moment-timezone'
import { ref } from "@vue/reactivity";
import { computed, watchEffect } from "@vue/runtime-core";
import {
    MDBTable,
    MDBModal,
    MDBModalHeader,
    MDBModalTitle,
    MDBModalBody,
} from "mdb-vue-ui-kit";
import { acceptBook,rejectBook } from "../../api";
import { useToast } from "vue-toastification";

const props = defineProps({
    bookingModal: Boolean,
    data: Object,
});
const toast = useToast();
const emit = defineEmits(["closeModal"]);

const address = computed(() => {
    return props.data.user.user_detail.address_line_1 ?
        props.data.user.user_detail.address_line_1 +
        props.data.user.user_detail.address_line_2 :
        "N/A";
});
const setEstimatedTime = (time) => {
    if (time) {
        return moment.tz(time, "Asia/Karachi").format('MMMM Do YYYY, HH:mm:ss a')
    }
}
const acceptBooking = (id) => {
    const formData = new FormData();
    
    formData.append("id", id);
    acceptBook(formData).then(({ data }) => {
        toast.success('Booking accepted');
        // $('#booking-detail').modal('hide')
        emit('closeModal')
        location.reload();
    });
}
const rejectBooking = (id) => {
    const formData = new FormData();
    
    formData.append("id", id);

    rejectBook(formData).then(({ data }) => {
        toast.error('Booking has been rejected');
        // $('#booking-detail').modal('hide')
        emit('closeModal')
        location.reload();
 
    });
}
// const getStatus=(status)=>{
//     console.log(status)
//     if(status=='droped'){
//         return '<span class="red">Droped</span>'
//     }
//     if(status=='pending'){
//          return '<span class="blue">Pending</span>'
//     }
//     if(status=='completed'){
        
//          return '<span class="green">Completed</span>'
//     }
// }
const services = computed(() => {
    return props.data.booking_services.map((service) => {
        return service.service_name;
    })
})

</script>
<style scoped>
.ok-btn {
    padding: 0.3rem 2rem;
}

.booking-detials-table td {
    border-bottom: 0;
    padding-bottom: 0.4rem;
}

.booking-detials-table td:first-child {
    padding-left: 0;
}

</style>
