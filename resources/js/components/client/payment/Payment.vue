<template>
    <div>
        <MDBContainer class="mt-5 pt-5">
            <MDBRow center class="mt-4">
                <MDBCol col="6">
                    <PaymentDetail />
                </MDBCol>
                <MDBCol col="4">
                    <PaymentMethod />
                </MDBCol>
            </MDBRow>
        </MDBContainer>
    </div>
</template>

<script setup>
import PaymentDetail from './PaymentDetail.vue';
import PaymentMethod from './PaymentMethod.vue';

</script>

