<template>
    <div class="wrapper">
        <h2 class="bank__title">
            Business hours
        </h2>
        <div class="main_container">
            <h2 class="_titlelabel">Shop Open/Close</h2>
            <div class="row_custom">
                <div class="form-group">
<!--                     <select name="business_days_from" v-model='business_days_from' required id="business_days__from">
                        <option value="7"> Sunday</option>
                        <option value="1"> Monday</option>
                        <option value="2"> Tuesday</option>
                        <option value="3"> Wednsday</option>
                        <option value="4"> Thirsday</option>
                        <option value="5"> Friday</option>
                        <option value="6"> Saturday</option>
                    </select> -->
                    <select name="is_open" v-model='is_open' required id="is_open">
                        <option value="1"> Open</option>
                        <option value="0"> Close</option>

                    </select>
                </div>
        <!--         <div class="col-12 col-sm-1">
                    <div class="_from">
                        <span>To</span>
                    </div>
                </div> -->
<!--                 <div class="form-group">
                    <select name="business_days_to" v-model='business_days_to' required id="business_days_to">
                        <option value="7"> Sunday</option>
                        <option value="1"> Monday</option>
                        <option value="2"> Tuesday</option>
                        <option value="3"> Wednsday</option>
                        <option value="4"> Thirsday</option>
                        <option value="5"> Friday</option>
                        <option value="6"> Saturday</option>
                    </select>
                </div> -->
            </div>
            <h2 class="_titlelabel">Shop Time</h2>
            <div class="row_custom">
                <div class="form-group">
                    <select v-model='form_time_span' name="form_time_span" required class="_select">
                        <option value="AM">AM</option>
                        <option value="PM">PM</option>
                    </select>
                    <input type="time" v-model='from_time' id="from_time" class="without_ampm" required name="from_time" placeholder="12:00">
                </div>
                <div class="col-12 col-sm-1">
                    <div class="_from">
                        <span>To</span>
                    </div>
                </div>
                <div class="form-group">
                    <select name="to_time_span" v-model='to_time_span' required class="_select">
                        <option value="Am">AM</option>
                        <option value="PM">PM</option>
                    </select>
                    <input type="time" v-model='to_time' class="without_ampm" required name="to_time" placeholder="12:00">
                </div>
            </div>
            <div class="shop__footer">
                <div class="shop_image">
                    <img src="../../../assets/img/schedule.png" alt="img" srcset="">
                   
                </div>
            </div>
            <div class="buttons__shop">
                <div class="buttons">
                   <!--  <button class="btn_cancel btn">
                        Cancel
                    </button> -->
                    <button @click='addScheduleHandler()' style="color:white" class="btn_add btn">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref, watchEffect } from "@vue/runtime-core";
import { useRouter } from "vue-router";
import { useStore } from "vuex";
import { MDBInput } from "mdb-vue-ui-kit";
import { useToast } from "vue-toastification";
import { reactive } from "@vue/reactivity";

import { addShopSchedule, getUserBank } from "../../../api";

const toast = useToast();

const store = useStore();
const router = useRouter();

const is_open = ref("1");
// const business_days_to = ref("7");
const loading = ref(false);
const errors = ref(null);
const form_time_span = ref("AM");
const from_time = ref('09:00');
const to_time_span = ref("PM");
const to_time = ref('09:00');

// const credentials = reactive({
//     business_days_from: "",
//     business_days_to: "",
//     form_time_span: "",
//     from_time: "",
//     to_time_span: "",
//     to_time: "",
// });

watchEffect(() => {
    // store.dispatch("providerRedirection");
});

// getUserBank().then(({ data }) => {
//     bank_detail.value = data.data;
//     if (bank_detail.value) {
//         bankName.value = bank_detail.value.bank_name;
//         bankNumber.value = bank_detail.value.account_number;
//     }
// });

const addScheduleHandler = () => {
    
    const formData = new FormData();
   
    formData.append("is_open", is_open.value);
    // formData.append("business_days_to", business_days_to.value);
    // formData.append("form_time_span", form_time_span.value);
    formData.append("from_time", from_time.value+' '+form_time_span.value);
    // formData.append("to_time_span", to_time_span.value);
    formData.append("to_time", to_time.value+' '+to_time_span.value);

    addShopSchedule(formData)
        .then((response) => {
            errors.value = null;
            if (response.data.success == true) {
                store.state.isTimeAdded=true
            }
            toast.success("Changes Saved Successfully!");
        })
        .catch((err) => {
            errors.value = err.response.data.errors;
        });
};

</script>
