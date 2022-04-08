<template>
    <div class="bg-white shadow-6-strong p-3 rounded-5 filter-box">
        <div class="d-flex align-items-center">
            <select name="location" id="location" class="form-select border-0 me-4">
                <option value="">Location</option>
                <option value="location-1">Location 1</option>
                <option value="location-2">Location 2</option>
                <option value="location-3">Location 3</option>
            </select>

            <select name="category" id="category" class="form-select border-0 me-4">
                <option value="">Category</option>
                <option value="category-1">Category 1</option>
                <option value="category-2">Category 2</option>
                <option value="category-3">Category 3</option>
            </select>

            <MDBBtn class="text-white bg-orange w-25">Search</MDBBtn>
        </div>
    </div>
</template>

<script setup>
</script>