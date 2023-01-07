<template>
    <div class="modal fade" id="modifyemailModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="py-4 text-center">
                        <h4 class="fw-bold mt-3">Do you want to Close Shop?</h4>
                        <small>
                            <b class="text-orange">Note:</b> Your Shop will show as closed to customers and cannot get the bookings.
                        </small>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mt-4">
                        <button type="button" class="ok-btn text-capitalize shadow-0 border" data-dismiss="modal">Close</button>
                        <button type="button" @click="handleDelete()" class="bg-orange text-white ok-btn text-capitalize">ok</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
const handleDelete = () => {

};

</script>
<style scoped>
.ok-btn {
    padding: 0.3rem 2rem;
}

</style>
