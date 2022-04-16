<template>
    <div class="mt-5 pt-5">
        <div class="container">
            <div class="row">
                <div class="col-5">
                    <div class="booking-list-filters mb-3">
                        <form action="">
                            <div class="d-flex">
                                <select name="location" id="" class="form-select me-3 fw-bold rounded-5">
                                    <option value="">Location</option>
                                    <option value="loc-1">Location 1</option>
                                    <option value="loc-2">Location 2</option>
                                    <option value="loc-3">Location 3</option>
                                </select>
                                <select name="date" id="" class="form-select me-3 fw-bold rounded-5">
                                    <option value="">Date</option>
                                    <option value="loc-1">Date 1</option>
                                    <option value="loc-2">Date 2</option>
                                    <option value="loc-3">Date 3</option>
                                </select>
                                <select name="category" id="" class="form-select me-3 fw-bold rounded-5">
                                    <option value="">Category</option>
                                    <option value="loc-1">Category 1</option>
                                    <option value="loc-2">Category 2</option>
                                    <option value="loc-3">Category 3</option>
                                </select>
                                <MDBBtn class="bg-orange text-white rounded-5 shadow-4-strong fw-bold flex-shrink-0">
                                    Search
                                </MDBBtn>
                            </div>
                        </form>
                    </div>
                    <div class="booking-profiles">
                        <div class="mb-3 rounded-5 border p-3">
                            <div class="d-flex align-items-start">
                                <img src="" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-7">

                </div>
            </div>
        </div>
    </div>
</template>

<script setup>

</script>
