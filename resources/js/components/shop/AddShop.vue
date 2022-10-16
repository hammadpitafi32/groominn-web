<template>
    <MDBContainer fluid>
        <MDBRow>
            <MDBCol col="12">
                <div class="p-5 pt-4">
                    <div class="py-5 px-4 rounded-5 bg-light-grey shop-form">
                        <form action="">
                            <div class="form-group mb-3">
                                <label for="name" class="mb-2 fw-bold small"
                                    >Business Name</label
                                >
                                <MDBInput
                                    id="name"
                                    v-model="businessName"
                                    class="bg-white py-2"
                                />
                                <span
                                    v-if="errors && errors.name"
                                    class="text-danger small"
                                    >{{ errors.name[0] }}</span
                                >
                            </div>
                            <div class="form-group mb-3">
                                <label for="address" class="mb-2 fw-bold small"
                                    >Address</label
                                >
                                <GMapAutocomplete
                                    class="form-control bg-white py-2"
                                    id="googleAutoComplete"
                                    placeholder=""
                                    @place_changed="setPlace"
                                />
                                <span
                                    v-if="errors && errors.address"
                                    class="text-danger small"
                                    >{{ errors.address[0] }}</span
                                >
                            </div>
                            <div class="form-group mb-3">
                                <label
                                    for="employees"
                                    class="mb-2 fw-bold small"
                                    >Numbers of Employees</label
                                >
                                <MDBInput
                                    id="employees"
                                    type="number"
                                    v-model="employees"
                                    class="bg-white py-2"
                                />
                                <!-- <span
                  v-if="errors && errors.address"
                  class="text-danger small"
                  >{{ errors.employees[0] }}</span
                > -->
                            </div>
                            <div class="form-group mb-3">
                                <label
                                    for="description"
                                    class="mb-2 fw-bold small"
                                    >Description</label
                                >
                                <MDBTextarea
                                    rows="5"
                                    v-model="description"
                                    id="description"
                                    class="bg-white py-2 no-resize"
                                />
                                <span
                                    v-if="errors && errors.description"
                                    class="text-danger small"
                                    >{{ errors.description[0] }}</span
                                >
                            </div>
                            <MDBRow>
                                <MDBCol col="3">
                                    <div class="mb-2 fw-bold small">
                                        Upload shop Photos (Optional)
                                    </div>
                                    <label
                                        for="shop-pics"
                                        class="custom-drag-label"
                                        :class="drag.shop && 'drag-entered'"
                                        @dragover="drag.shop = true"
                                        @dragleave="drag.shop = false"
                                        @dragend="drag.shop = false"
                                        @drop="drag.shop = false"
                                    >
                                        <svg
                                            width="26"
                                            height="17"
                                            viewBox="0 0 26 17"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                d="M25.8508 10.0979L22.5816 15.5943C22.3272 16.0221 21.963 16.3769 21.5251 16.6236C21.0873 16.8702 20.5912 17 20.0863 17H2.03238C1.19627 17 0.675323 16.1105 1.0966 15.4021L4.36574 9.90569C4.62016 9.47794 4.98443 9.12306 5.42227 8.87642C5.8601 8.62978 6.3562 8.5 6.86111 8.5H24.915C25.7512 8.5 26.2721 9.38953 25.8508 10.0979ZM6.86111 7.08333H21.6667V4.95833C21.6667 3.78471 20.6966 2.83333 19.5 2.83333H12.2778L9.38889 0H2.16667C0.970035 0 0 0.95138 0 2.125V14.4343L3.11806 9.19186C3.89161 7.89128 5.32589 7.08333 6.86111 7.08333Z"
                                                fill="#F05922"
                                            />
                                        </svg>
                                        <span class="ms-2"
                                            >Drag & drop your file here</span
                                        >
                                        <MDBFile
                                            id="shop-pics"
                                            @change="uploadPics($event, 'shop')"
                                            class="mb-2 custom-file-type"
                                        />
                                    </label>

                                    <div
                                        class="row mt-3"
                                        v-if="shopPics.length > 0"
                                    >
                                        <div
                                            class="col-4 pb-3"
                                            v-for="(image, index) in shopPics"
                                            :key="index"
                                        >
                                            <div class="image-wrap">
                                                <img
                                                    :src="image"
                                                    alt=""
                                                    class="img-fluid rounded-5"
                                                />
                                                <span
                                                    class="remove-img"
                                                    @click="
                                                        shopPics.splice(
                                                            index,
                                                            1
                                                        ),
                                                            shopPicsForApi.splice(
                                                                index,
                                                                1
                                                            )
                                                    "
                                                >
                                                    <svg
                                                        width="24"
                                                        height="24"
                                                        viewBox="0 0 24 24"
                                                        fill="none"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                    >
                                                        <g
                                                            filter="url(#filter0_d_124_2055)"
                                                        >
                                                            <circle
                                                                cx="12"
                                                                cy="8"
                                                                r="8"
                                                                fill="white"
                                                            />
                                                            <circle
                                                                cx="12"
                                                                cy="8"
                                                                r="7.75"
                                                                stroke="#F05922"
                                                                stroke-width="0.5"
                                                            />
                                                        </g>
                                                        <path
                                                            d="M13.3563 11.0018L11.7963 8.55378L10.2962 11.0018H9.15625L11.2803 7.73778L9.15625 4.42578H10.3923L11.9523 6.86178L13.4402 4.42578H14.5803L12.4683 7.67778L14.5923 11.0018H13.3563Z"
                                                            fill="#F05922"
                                                        />
                                                        <defs>
                                                            <filter
                                                                id="filter0_d_124_2055"
                                                                x="0"
                                                                y="0"
                                                                width="24"
                                                                height="24"
                                                                filterUnits="userSpaceOnUse"
                                                                color-interpolation-filters="sRGB"
                                                            >
                                                                <feFlood
                                                                    flood-opacity="0"
                                                                    result="BackgroundImageFix"
                                                                />
                                                                <feColorMatrix
                                                                    in="SourceAlpha"
                                                                    type="matrix"
                                                                    values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
                                                                    result="hardAlpha"
                                                                />
                                                                <feOffset
                                                                    dy="4"
                                                                />
                                                                <feGaussianBlur
                                                                    stdDeviation="2"
                                                                />
                                                                <feComposite
                                                                    in2="hardAlpha"
                                                                    operator="out"
                                                                />
                                                                <feColorMatrix
                                                                    type="matrix"
                                                                    values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"
                                                                />
                                                                <feBlend
                                                                    mode="normal"
                                                                    in2="BackgroundImageFix"
                                                                    result="effect1_dropShadow_124_2055"
                                                                />
                                                                <feBlend
                                                                    mode="normal"
                                                                    in="SourceGraphic"
                                                                    in2="effect1_dropShadow_124_2055"
                                                                    result="shape"
                                                                />
                                                            </filter>
                                                        </defs>
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </MDBCol>
                                <MDBCol col="3">
                                    <div class="mb-2 fw-bold small">
                                        Upload CNIC Front
                                    </div>
                                    <label
                                        for="cnic-front"
                                        class="custom-drag-label"
                                        :class="drag.front && 'drag-entered'"
                                        @dragover="drag.front = true"
                                        @dragleave="drag.front = false"
                                        @dragend="drag.front = false"
                                        @drop="drag.front = false"
                                    >
                                        <svg
                                            width="26"
                                            height="17"
                                            viewBox="0 0 26 17"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                d="M25.8508 10.0979L22.5816 15.5943C22.3272 16.0221 21.963 16.3769 21.5251 16.6236C21.0873 16.8702 20.5912 17 20.0863 17H2.03238C1.19627 17 0.675323 16.1105 1.0966 15.4021L4.36574 9.90569C4.62016 9.47794 4.98443 9.12306 5.42227 8.87642C5.8601 8.62978 6.3562 8.5 6.86111 8.5H24.915C25.7512 8.5 26.2721 9.38953 25.8508 10.0979ZM6.86111 7.08333H21.6667V4.95833C21.6667 3.78471 20.6966 2.83333 19.5 2.83333H12.2778L9.38889 0H2.16667C0.970035 0 0 0.95138 0 2.125V14.4343L3.11806 9.19186C3.89161 7.89128 5.32589 7.08333 6.86111 7.08333Z"
                                                fill="#F05922"
                                            />
                                        </svg>
                                        <span class="ms-2"
                                            >Drag & drop your file here</span
                                        >
                                        <MDBFile
                                            id="cnic-front"
                                            @change="
                                                uploadPics($event, 'cnic-front')
                                            "
                                            class="custom-file-type"
                                            accept="image/*"
                                        />
                                    </label>
                                    <span
                                        v-if="errors && errors.cnic_front"
                                        class="text-danger small"
                                        >{{ errors.cnic_front[0] }}</span
                                    >
                                    <div class="row mt-3" v-if="cnicFront">
                                        <div class="col-4 pb-3">
                                            <div class="image-wrap">
                                                <img
                                                    :src="cnicFront"
                                                    alt=""
                                                    class="img-fluid rounded-5"
                                                />
                                                <span
                                                    class="remove-img"
                                                    @click="cnicFront = ''"
                                                >
                                                    <svg
                                                        width="24"
                                                        height="24"
                                                        viewBox="0 0 24 24"
                                                        fill="none"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                    >
                                                        <g
                                                            filter="url(#filter0_d_124_2055)"
                                                        >
                                                            <circle
                                                                cx="12"
                                                                cy="8"
                                                                r="8"
                                                                fill="white"
                                                            />
                                                            <circle
                                                                cx="12"
                                                                cy="8"
                                                                r="7.75"
                                                                stroke="#F05922"
                                                                stroke-width="0.5"
                                                            />
                                                        </g>
                                                        <path
                                                            d="M13.3563 11.0018L11.7963 8.55378L10.2962 11.0018H9.15625L11.2803 7.73778L9.15625 4.42578H10.3923L11.9523 6.86178L13.4402 4.42578H14.5803L12.4683 7.67778L14.5923 11.0018H13.3563Z"
                                                            fill="#F05922"
                                                        />
                                                        <defs>
                                                            <filter
                                                                id="filter0_d_124_2055"
                                                                x="0"
                                                                y="0"
                                                                width="24"
                                                                height="24"
                                                                filterUnits="userSpaceOnUse"
                                                                color-interpolation-filters="sRGB"
                                                            >
                                                                <feFlood
                                                                    flood-opacity="0"
                                                                    result="BackgroundImageFix"
                                                                />
                                                                <feColorMatrix
                                                                    in="SourceAlpha"
                                                                    type="matrix"
                                                                    values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
                                                                    result="hardAlpha"
                                                                />
                                                                <feOffset
                                                                    dy="4"
                                                                />
                                                                <feGaussianBlur
                                                                    stdDeviation="2"
                                                                />
                                                                <feComposite
                                                                    in2="hardAlpha"
                                                                    operator="out"
                                                                />
                                                                <feColorMatrix
                                                                    type="matrix"
                                                                    values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"
                                                                />
                                                                <feBlend
                                                                    mode="normal"
                                                                    in2="BackgroundImageFix"
                                                                    result="effect1_dropShadow_124_2055"
                                                                />
                                                                <feBlend
                                                                    mode="normal"
                                                                    in="SourceGraphic"
                                                                    in2="effect1_dropShadow_124_2055"
                                                                    result="shape"
                                                                />
                                                            </filter>
                                                        </defs>
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </MDBCol>
                                <MDBCol col="3">
                                    <div class="mb-2 fw-bold small">
                                        Upload CNIC Back
                                    </div>
                                    <label
                                        for="cnic-back"
                                        class="custom-drag-label"
                                        :class="drag.back && 'drag-entered'"
                                        @dragover="drag.back = true"
                                        @dragleave="drag.back = false"
                                        @dragend="drag.back = false"
                                        @drop="drag.back = false"
                                    >
                                        <svg
                                            width="26"
                                            height="17"
                                            viewBox="0 0 26 17"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                d="M25.8508 10.0979L22.5816 15.5943C22.3272 16.0221 21.963 16.3769 21.5251 16.6236C21.0873 16.8702 20.5912 17 20.0863 17H2.03238C1.19627 17 0.675323 16.1105 1.0966 15.4021L4.36574 9.90569C4.62016 9.47794 4.98443 9.12306 5.42227 8.87642C5.8601 8.62978 6.3562 8.5 6.86111 8.5H24.915C25.7512 8.5 26.2721 9.38953 25.8508 10.0979ZM6.86111 7.08333H21.6667V4.95833C21.6667 3.78471 20.6966 2.83333 19.5 2.83333H12.2778L9.38889 0H2.16667C0.970035 0 0 0.95138 0 2.125V14.4343L3.11806 9.19186C3.89161 7.89128 5.32589 7.08333 6.86111 7.08333Z"
                                                fill="#F05922"
                                            />
                                        </svg>
                                        <span class="ms-2"
                                            >Drag & drop your file here</span
                                        >
                                        <MDBFile
                                            id="cnic-back"
                                            @change="
                                                uploadPics($event, 'cnic-back')
                                            "
                                            class="mb-2 custom-file-type"
                                        />
                                    </label>
                                    <span
                                        v-if="errors && errors.cnic_back"
                                        class="text-danger small"
                                        >{{ errors.cnic_back[0] }}</span
                                    >
                                    <div class="row mt-3" v-if="cnicBack">
                                        <div class="col-4 pb-3">
                                            <div class="image-wrap">
                                                <img
                                                    :src="cnicBack"
                                                    alt=""
                                                    class="img-fluid rounded-5"
                                                />
                                                <span
                                                    class="remove-img"
                                                    @click="cnicBack = ''"
                                                >
                                                    <svg
                                                        width="24"
                                                        height="24"
                                                        viewBox="0 0 24 24"
                                                        fill="none"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                    >
                                                        <g
                                                            filter="url(#filter0_d_124_2055)"
                                                        >
                                                            <circle
                                                                cx="12"
                                                                cy="8"
                                                                r="8"
                                                                fill="white"
                                                            />
                                                            <circle
                                                                cx="12"
                                                                cy="8"
                                                                r="7.75"
                                                                stroke="#F05922"
                                                                stroke-width="0.5"
                                                            />
                                                        </g>
                                                        <path
                                                            d="M13.3563 11.0018L11.7963 8.55378L10.2962 11.0018H9.15625L11.2803 7.73778L9.15625 4.42578H10.3923L11.9523 6.86178L13.4402 4.42578H14.5803L12.4683 7.67778L14.5923 11.0018H13.3563Z"
                                                            fill="#F05922"
                                                        />
                                                        <defs>
                                                            <filter
                                                                id="filter0_d_124_2055"
                                                                x="0"
                                                                y="0"
                                                                width="24"
                                                                height="24"
                                                                filterUnits="userSpaceOnUse"
                                                                color-interpolation-filters="sRGB"
                                                            >
                                                                <feFlood
                                                                    flood-opacity="0"
                                                                    result="BackgroundImageFix"
                                                                />
                                                                <feColorMatrix
                                                                    in="SourceAlpha"
                                                                    type="matrix"
                                                                    values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
                                                                    result="hardAlpha"
                                                                />
                                                                <feOffset
                                                                    dy="4"
                                                                />
                                                                <feGaussianBlur
                                                                    stdDeviation="2"
                                                                />
                                                                <feComposite
                                                                    in2="hardAlpha"
                                                                    operator="out"
                                                                />
                                                                <feColorMatrix
                                                                    type="matrix"
                                                                    values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"
                                                                />
                                                                <feBlend
                                                                    mode="normal"
                                                                    in2="BackgroundImageFix"
                                                                    result="effect1_dropShadow_124_2055"
                                                                />
                                                                <feBlend
                                                                    mode="normal"
                                                                    in="SourceGraphic"
                                                                    in2="effect1_dropShadow_124_2055"
                                                                    result="shape"
                                                                />
                                                            </filter>
                                                        </defs>
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </MDBCol>
                                <MDBCol col="3">
                                    <div class="mb-2 fw-bold small">
                                        Shop Liscence
                                    </div>
                                    <label
                                        for="shop-liscence"
                                        class="custom-drag-label"
                                        :class="drag.liscence && 'drag-entered'"
                                        @dragover="drag.liscence = true"
                                        @dragleave="drag.liscence = false"
                                        @dragend="drag.liscence = false"
                                        @drop="drag.liscence = false"
                                    >
                                        <svg
                                            width="26"
                                            height="17"
                                            viewBox="0 0 26 17"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                d="M25.8508 10.0979L22.5816 15.5943C22.3272 16.0221 21.963 16.3769 21.5251 16.6236C21.0873 16.8702 20.5912 17 20.0863 17H2.03238C1.19627 17 0.675323 16.1105 1.0966 15.4021L4.36574 9.90569C4.62016 9.47794 4.98443 9.12306 5.42227 8.87642C5.8601 8.62978 6.3562 8.5 6.86111 8.5H24.915C25.7512 8.5 26.2721 9.38953 25.8508 10.0979ZM6.86111 7.08333H21.6667V4.95833C21.6667 3.78471 20.6966 2.83333 19.5 2.83333H12.2778L9.38889 0H2.16667C0.970035 0 0 0.95138 0 2.125V14.4343L3.11806 9.19186C3.89161 7.89128 5.32589 7.08333 6.86111 7.08333Z"
                                                fill="#F05922"
                                            />
                                        </svg>
                                        <span class="ms-2"
                                            >Drag & drop your file here</span
                                        >
                                        <MDBFile
                                            id="shop-liscence"
                                            @change="
                                                uploadPics($event, 'liscence')
                                            "
                                            class="mb-2 custom-file-type"
                                        />
                                    </label>
                                    <span
                                        v-if="errors && errors.license"
                                        class="text-danger small"
                                        >{{ errors.license[0] }}</span
                                    >
                                    <div class="row mt-3" v-if="Liscence">
                                        <div class="col-4 pb-3">
                                            <div class="image-wrap">
                                                <img
                                                    :src="Liscence"
                                                    alt=""
                                                    class="img-fluid rounded-5"
                                                />
                                                <span
                                                    class="remove-img"
                                                    @click="Liscence = ''"
                                                >
                                                    <svg
                                                        width="24"
                                                        height="24"
                                                        viewBox="0 0 24 24"
                                                        fill="none"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                    >
                                                        <g
                                                            filter="url(#filter0_d_124_2055)"
                                                        >
                                                            <circle
                                                                cx="12"
                                                                cy="8"
                                                                r="8"
                                                                fill="white"
                                                            />
                                                            <circle
                                                                cx="12"
                                                                cy="8"
                                                                r="7.75"
                                                                stroke="#F05922"
                                                                stroke-width="0.5"
                                                            />
                                                        </g>
                                                        <path
                                                            d="M13.3563 11.0018L11.7963 8.55378L10.2962 11.0018H9.15625L11.2803 7.73778L9.15625 4.42578H10.3923L11.9523 6.86178L13.4402 4.42578H14.5803L12.4683 7.67778L14.5923 11.0018H13.3563Z"
                                                            fill="#F05922"
                                                        />
                                                        <defs>
                                                            <filter
                                                                id="filter0_d_124_2055"
                                                                x="0"
                                                                y="0"
                                                                width="24"
                                                                height="24"
                                                                filterUnits="userSpaceOnUse"
                                                                color-interpolation-filters="sRGB"
                                                            >
                                                                <feFlood
                                                                    flood-opacity="0"
                                                                    result="BackgroundImageFix"
                                                                />
                                                                <feColorMatrix
                                                                    in="SourceAlpha"
                                                                    type="matrix"
                                                                    values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
                                                                    result="hardAlpha"
                                                                />
                                                                <feOffset
                                                                    dy="4"
                                                                />
                                                                <feGaussianBlur
                                                                    stdDeviation="2"
                                                                />
                                                                <feComposite
                                                                    in2="hardAlpha"
                                                                    operator="out"
                                                                />
                                                                <feColorMatrix
                                                                    type="matrix"
                                                                    values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"
                                                                />
                                                                <feBlend
                                                                    mode="normal"
                                                                    in2="BackgroundImageFix"
                                                                    result="effect1_dropShadow_124_2055"
                                                                />
                                                                <feBlend
                                                                    mode="normal"
                                                                    in="SourceGraphic"
                                                                    in2="effect1_dropShadow_124_2055"
                                                                    result="shape"
                                                                />
                                                            </filter>
                                                        </defs>
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </MDBCol>
                            </MDBRow>
                            <MDBRow class="mt-5">
                                <MDBCol col="12" class="text-end pt-4">
                                    <MDBBtn
                                        class="text-white bg-light-grey shadow-0 text-capitalize px-5 rounded-4"
                                    >
                                        Cancel
                                    </MDBBtn>
                                    <MDBBtn
                                        class="text-white bg-orange shadow-0 text-capitalize px-5 rounded-4 ms-3"
                                        :disabled="loading"
                                        @click="addShopHandler()"
                                    >
                                        <span v-if="!loading">Add shop</span>
                                        <BtnLoader v-else />
                                    </MDBBtn>
                                </MDBCol>
                            </MDBRow>
                        </form>
                    </div>
                </div>
            </MDBCol>
        </MDBRow>
    </MDBContainer>
</template>

<script setup>
import { reactive, ref } from "@vue/reactivity";
import { MDBInput, MDBTextarea, MDBFile } from "mdb-vue-ui-kit";
import { useRoute, useRouter } from "vue-router";
import BtnLoader from "../custom-components/BtnLoader.vue";
import { addShop, getUserBusiness } from "../../api";
import { onMounted, watch, watchEffect } from "@vue/runtime-core";
import { useStore } from "vuex";
import { useCookies } from "vue3-cookies";
import { asset } from "../../baseURL";
import { useToast } from "vue-toastification";

const router = useRouter();
const route = useRoute();
const store = useStore();
const toast = useToast();
const { cookies } = useCookies();

const dragOnCardFront = ref(false);
const dragOnCardBack = ref(false);
const dragOnShopImg = ref(false);

const drag = reactive({
    shop: false,
    front: false,
    back: false,
    liscence: false,
});

const imageUrl = ref("");
const businessName = ref("");
const description = ref("");
const address = reactive({
    place: "",
    lat: "",
    lng: "",
});
const employees = ref("");
const loading = ref(false);

const shopPics = ref([]);
const cnicFront = ref("");
const cnicBack = ref("");
const Liscence = ref("");

const shopPicsForApi = ref([]);
const cnicFrontForApi = ref("");
const cnicBackForApi = ref("");
const LiscenceForApi = ref("");

const success = ref(null);
const errors = ref(null);

const convertUrlToFile = async (url) => {
    let response = await fetch(url);
    let data = await response.blob();
    return new File([data], "image.jpg", {
        type: data.type,
    });
};

const getOwnProfile = async () => {
    let { data } = await getUserBusiness(route.params.id);
    let shop = data.data;
    businessName.value = shop.name;
    employees.value = shop.no_of_employees;
    description.value = shop.description;

    if (shop.user_business_images.length) {
        shop.user_business_images.map((img) => {
            let url = asset.baseUrl + img.name;
            convertUrlToFile(url).then((file) => {
                uploadPics(file, "shop", true);
            });
        });
    }
    if (shop.cnic_front) {
        let url = asset.baseUrl + shop.cnic_front;
        convertUrlToFile(url).then((file) => {
            uploadPics(file, "cnic-front", true);
        });
    }
    if (shop.cnic_back) {
        let url = asset.baseUrl + shop.cnic_back;
        convertUrlToFile(url).then((file) => {
            uploadPics(file, "cnic-back", true);
        });
    }
    if (shop.license) {
        let url = asset.baseUrl + shop.license;
        convertUrlToFile(url).then((file) => {
            uploadPics(file, "liscence", true);
        });
    }
    address.place = shop.address;
    address.lat = shop.latitude;
    address.lng = shop.longitude;
    document.getElementById("googleAutoComplete").value = shop.address;
};

watchEffect(() => {
    if (!store.state.auth) {
        router.push("/login");
    } else if (store.state.role == "Provider" && store.state.shop) {
        if (!route.params.id) {
            router.push("/my-shop");
        } else {
            getOwnProfile();
        }
    } else if (store.state.role == "Client") {
        router.push("/");
    }

    // console.log(address.value);
});

const uploadPics = (event, val, firstTimeSet) => {
    let array = [];
    firstTimeSet && array.push(event);
    const files = firstTimeSet ? array : event.target.files;
    const fileReader = new FileReader();
    fileReader.addEventListener("load", () => {
        if (val == "shop") {
            shopPics.value.push(fileReader.result);
            shopPicsForApi.value.push(files[0]);
        } else if (val == "cnic-front") {
            cnicFront.value = fileReader.result;
            cnicFrontForApi.value = files[0];
        } else if (val == "cnic-back") {
            cnicBack.value = fileReader.result;
            cnicBackForApi.value = files[0];
        } else if (val == "liscence") {
            Liscence.value = fileReader.result;
            LiscenceForApi.value = files[0];
        }
    });
    fileReader.readAsDataURL(files[0]);
};

const dragHandlner = (event) => {
    event.preventDefault();
    event.stopPropagation();
    console.log(event);
};

watch(cnicFront, () => {
    if (!cnicFront.value) {
        cnicFrontForApi.value = cnicFront.value;
    }
});
watch(cnicBack, () => {
    if (!cnicBack.value) {
        cnicBackForApi.value = cnicBack.value;
    }
});
watch(Liscence, () => {
    if (!Liscence.value) {
        LiscenceForApi.value = Liscence.value;
    }
});

watch("address.place", (val) => {
    console.log(val);
});

const addShopHandler = () => {
    loading.value = true;
    const formData = new FormData();
    formData.append("name", businessName.value);
    formData.append("address", address.place);
    formData.append("latitude", address.lat);
    formData.append("longitude", address.lng);
    formData.append("description", description.value);
    formData.append("cnic_front", cnicFrontForApi.value);
    formData.append("cnic_back", cnicBackForApi.value);
    formData.append("license", LiscenceForApi.value);
    formData.append("no_of_employees", employees.value);

    for (let i = 0; i < shopPicsForApi.value.length; i++) {
        formData.append("shop_images[]", shopPicsForApi.value[i]);
    }

    addShop(formData)
        .then((res) => {
            loading.value = false;
            errors.value = null;
            success.value = res.data;

            toast.success("Shop has been added successfully");
            let user = cookies.get("user");
            user.is_shop = true;
            cookies.set("user", user);
            store.dispatch("setAuth");

            setTimeout(() => {
                router.push("/my-shop");
            }, 900);
        })
        .catch((err) => {
            loading.value = false;
            success.value = null;
            errors.value = err.response.data.errors;
        });
};

const setPlace = (data) => {
    address.lat = data.geometry.location.lat();
    address.lng = data.geometry.location.lng();
    address.place = data.formatted_address;
};
</script>

<style scoped>
.image-wrap {
    position: relative;
    height: 55px;
    width: 65px;
}
.image-wrap img {
    height: 100%;
    width: 100%;
    object-fit: cover;
}
.remove-img {
    position: absolute;
    cursor: pointer;
    top: -10px;
    right: -10px;
}
</style>
