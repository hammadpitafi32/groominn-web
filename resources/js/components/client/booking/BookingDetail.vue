<template>
    <MDBContainer class="mt-5 pt-5">
        <MDBRow>
            <MDBCol col="12">
                <div
                    class="booking-table-parent px-5 py-4 rounded-6 bg-light-grey mb-5 mt-3"
                >
                    <h6 class="fw-bold my-4 px-3">
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
                        Bookings
                    </h6>
<div  class="table-responsive">
                    <table
                        class="table booking-table"
                        aria-describedby="booking-table"
                    >
                        <thead>
                            <th>Saloon name</th>
                            <th>E-mail</th>
                            <th>Estimated time</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th v-if="bookings.length"></th>
                        </thead>
                        <tbody v-if="loading">
                            <tr v-for="n in 4" :key="n">
                                <td class="px-3">
                                    <div class="skelton"></div>
                                </td>
                                <td class="px-3">
                                    <div class="skelton"></div>
                                </td>
                                <td class="px-3">
                                    <div class="skelton"></div>
                                </td>
                                <td class="px-3">
                                    <div class="skelton"></div>
                                </td>
                                <td class="px-3">
                                    <div class="skelton"></div>
                                </td>
                            </tr>
                        </tbody>
                        <tbody v-else-if="bookings.length">
                            <tr
                                v-for="(booking, index) in bookings"
                                :key="index"
                            >
                                <td>{{ booking.user_business.name }}</td>
                                <td>{{ booking.user_business.user.email }}</td>
                                <td>
                                    {{
                                        setEstimatedTime(booking.estimated_time)
                                    }}
                                </td>
                                <td>{{ booking.date.split(" ")[0] }}</td>
                                <td class="text-capitalize">
                                    {{ booking.status }}
                                </td>
                                <td class="text-end">
                                    <MDBBtn
                                        class="bg-orange text-white text-capitalize rounded-5 shadow-0 px-3"
                                    >
                                        {{
                                            booking.status == "pending"
                                                ? "Cancel Booking"
                                                : "Give Review"
                                        }}
                                    </MDBBtn>
                                </td>
                            </tr>
                        </tbody>
                        <tbody v-else>
                            <tr>
                                <td
                                    colspan="6"
                                    class="text-center fs-6 fw-bold"
                                >
                                    No Bookings Found
                                </td>
                            </tr>
                        </tbody>
                    </table>
</div>
                </div>
            </MDBCol>
        </MDBRow>
    </MDBContainer>
</template>

<script setup>
import { ref } from "@vue/reactivity";
import { watchEffect } from "@vue/runtime-core";
import { getBooking } from "../../../api";
import { useStore } from "vuex";

const bookings = ref([]);
const store = useStore();
const loading = ref(true);

getBooking().then(({ data }) => {
    bookings.value = data.data;
    loading.value = false;
});

const setEstimatedTime = (time) => {
    if (time) {
        let newTime = time.split(" ")[1];
        let hours = newTime.split(":")[0];
        let mins = newTime.split(":")[1];
        let ampm = hours >= 12 ? 'PM' : 'AM';
        hours %= 12;
        hours = hours || 12;
        mins = mins < 10 ? `0${mins}` : mins;
        return hours + ":" + mins + " " + ampm;
    } else {
        return "N/A";
    }
};

watchEffect(() => {
    store.dispatch("clientRedirection");
});
</script>

<style scoped>
.booking-table th {
    padding: 1rem 1.4rem;
}
.skelton {
    height: 26px;
}
</style>
