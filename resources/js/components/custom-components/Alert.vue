<template>
    <div
          class="alert"
          :class="apiResponse.success ? 'alert-success' : 'alert-danger'"
        >
          {{ apiResponse.message ? apiResponse.message : 'Login Successfully!' }}
        </div>
</template>

<script setup>

const props = defineProps({
    
})

</script>