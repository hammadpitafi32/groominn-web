<template>
    <div class="mt-5 pt-5 text-center">
        <h1 class="text-orange">
            Pages not found
        </h1>
    </div>
</template>
<script setup>

import { watch, watchEffect } from "@vue/runtime-core";
import { socialLogin } from "../../api";
import { useToast } from "vue-toastification";
import { onMounted } from 'vue';
import { useStore } from "vuex";
import { useRouter, useRoute } from "vue-router";

const store = useStore();
const toast = useToast();
const router = useRouter();
const route = useRoute();

watchEffect(() => {
    store.dispatch("redirection");
});
onMounted(() => {
			
            if(typeof(route.query.token) !== 'undefined'){
             
                var plateform='google';
                
                if(route.query.plateform=='facebook'){
                    plateform="facebook";
                }
               
                const formData = new FormData();

    			formData.append("token", route.query.token);
    			formData.append("plateform", plateform);

                socialLogin(formData)
                    .then((res) => {
                    	    toast.success("Login Successfully!");
                			store.dispatch("setLogin", res.data);
                			store.dispatch("redirection");
   
                });
            }
});

</script>