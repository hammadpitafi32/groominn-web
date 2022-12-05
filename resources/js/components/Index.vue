<template>
    <!-- section 1 -->
    <section class="banner-section">
        <MDBContainer fluid class="p-0 position-relative">
            <MDBCarousel v-model="carousel" fade :items="items" :pause="false" :interval="false" itemsClass="slider-image img-fluid" class="main-slider" />
            <div class="text-on-slider">
                <h2 class="fw-bold">
                    Connecting to you salons
                    <span class="text-orange d-block">in your area</span>
                </h2>
                <p class="small">
                    Groominn is here to book an Appointment for you without <br />
                    making a call
                </p>
                <MDBBtn class="bg-orange text-white text-capitalize" @click="
            store.state.auth
              ? router.push('/booking-list')
              : router.push('/register')
          ">Get Started</MDBBtn>
            </div>
        </MDBContainer>
    </section>
    <!-- section 1 end -->
    <!-- section 2 -->
    <section class="filter-section pb-5">
        <MDBContainer>
            <MDBRow>
                <MDBCol col="8" class="mx-auto">
                    <Filters />
                </MDBCol>
            </MDBRow>
        </MDBContainer>
    </section>
    <!-- section 2 end -->
    <!-- section 3 -->
    <section class="section-3 pt-5">
        <MDBContainer fluid>
            <MDBRow>
                <MDBCol col="2 text-center">
                    <img src="../assets/img/pnik-grooming.svg" class="img-fluid" alt="" :style="{ height: imageHeight + 'px' }" />
                </MDBCol>
                <MDBCol col="10">
                    <div ref="rightSide">
                        <MDBRow>
                            <MDBCol col="10" class="mx-auto text-center">
                                <h2 class="text-orange fw-bold mb-3">Why choose Groominn?</h2>
                                <p class="text-color-1 small">
                                    At Groominn, we care about the well-being of our customers and stylists. Explore hair salon franchising opportunities with Great groominn app.
                                    We look forward to giving you the haircut you want or any service which will groom you. To make it more convenient for you, use Online groominn app to add your name to the waitlist at a hair salon near you.
                                </p>
                            </MDBCol>
                        </MDBRow>
                        <MDBRow class="mt-5">
                            <MDBCol col="4">
                                <div class="text-center h-100">
                                    <MDBCard class="shadow-2 features-card h-100 pt-4">
                                        <img src="../assets/img/fast-easy-booking.svg" alt="..." class="img-fluid" />
                                        <MDBCardBody class="mt-4">
                                            <MDBCardTitle class="mb-4">Fast & Easy Booking</MDBCardTitle>
                                            <MDBCardText class="text-color-1 small">
                                                We want all our customers to feel confident and happy leaving the beauty salon, which is why your complete satisfaction on all services and products is fully guaranteed. When you're at Groominn, you know It's Gonna Be Great.
                                            </MDBCardText>
                                        </MDBCardBody>
                                    </MDBCard>
                                </div>
                            </MDBCol>
                            <MDBCol col="4">
                                <div class="text-center h-100 bg-after-orange">
                                    <MDBCard class="shadow-4-strong features-card h-100 pt-4">
                                        <img src="../assets/img/save-time.svg" alt="..." class="img-fluid" />
                                        <MDBCardBody class="mt-4">
                                            <MDBCardTitle class="mb-4">Save time</MDBCardTitle>
                                            <MDBCardText class="text-color-1 small">
                                                Basic concept of groominn is to save the customer time, thats our first priority. So you can checkin in to any salon by groominn with out any hustle.
                                            </MDBCardText>
                                        </MDBCardBody>
                                    </MDBCard>
                                </div>
                            </MDBCol>
                            <MDBCol col="4">
                                <div class="text-center h-100">
                                    <div class="text-center h-100">
                                        <MDBCard class="shadow-2 features-card h-100 pt-4">
                                            <img src="../assets/img/satisfied-customer.svg" alt="..." class="img-fluid" />
                                            <MDBCardBody class="mt-4">
                                                <MDBCardTitle class="mb-4">Satisfied coustomers</MDBCardTitle>
                                                <MDBCardText class="text-color-1 small">
                                                    We want all our customers to feel confident and happy leaving the groominn, which is why your complete satisfaction on all services are fully guaranteed.
                                                </MDBCardText>
                                            </MDBCardBody>
                                        </MDBCard>
                                    </div>
                                </div>
                            </MDBCol>
                        </MDBRow>
                        <!-- section 4 -->
                        <section class="find-best-section mt-5 pt-4 pb-5">
                            <MDBContainer fluid>
                                <MDBRow>
                                    <MDBCol col="12">
                                        <h2 class="fw-bold text-color-2">Find the best</h2>
                                        <h4 class="text-orange">Services in the town</h4>
                                    </MDBCol>
                                    <MDBCol col="4" offset="8">
                                        <MDBBtn class="btn-custom-white shadow-0 text-capitalize" @click="showAll = !showAll">
                                            {{
                                            showAll ? "Show Less catagories" : "Show All catagories"
                                            }}
                                        </MDBBtn>
                                    </MDBCol>
                                </MDBRow>
                                <MDBRow>
                                    <MDBCol col="12 pt-5">
                                        <div class="category-boxes d-flex pb-5" :class="showAll && 'flex-wrap'">
                                            <div v-for="(category, index) in categories" :key="index" class="category-box bg-white rounded-6 p-3 me-3 mb-3">
                                                <div class="man-image" :style="{ backgroundColor: category.bgColor }">
                                                    <img :src="category.image" class="img-fluid" alt="" />
                                                </div>
                                                <h5 class="mt-5 mb-1 text-color-2">
                                                    {{ category.title }}
                                                </h5>
                                                <p class="small">
                                                    <span :style="{ color: category.color }">25</span>
                                                    Listing
                                                </p>
                                            </div>
                                        </div>
                                    </MDBCol>
                                </MDBRow>
                            </MDBContainer>
                        </section>
                        <!-- section 4 end -->
                    </div>
                </MDBCol>
            </MDBRow>
        </MDBContainer>
    </section>
    <!-- section 3 end -->
    <!-- section 5 -->
    <section class="section-5">
        <MDBContainer fluid class="ps-0">
            <MDBRow>
                <MDBCol col="6" class="position-relative">
                    <div class="
              orange-background
              d-flex
              align-items-center
              justify-content-end
              pe-5
            ">
                        <img src="../assets/img/girl.svg" alt="" class="img-fluid girl-img w-75" />
                        <img src="../assets/img/map.svg" alt="" class="img-fluid w-25" />
                    </div>
                    <div class="text-box position-absolute text-center">
                        <img src="../assets/img/logo-2.svg" class="img-fluid" alt="" />
                        <small class="text-dark d-block mt-3">Groominn is here to book an Appointment without making a call</small>
                    </div>
                </MDBCol>
                <MDBCol col="6">
                    <div class="right-side position-relative pt-5">
                        <h2 class="fw-bold">Hundreds of hair styles, one great service.</h2>
                        <p class="text-color-2 small">
                            We look forward to giving you the best services you want. Lets have a look what we and our salons are offering.
                        </p>
                        <div class="side-card d-flex align-items-start mt-4 pt-3">
                            <div class="man-image me-4">
                                <img src="../assets/img/man.svg" class="img-fluid" alt="" />
                            </div>
                            <div class="text-area">
                                <h5 class="fw-bold text-orange">Make up for Women</h5>
                                <p class="text-color-2 small">
                                    Looking for a fresh, women's haircut or bridal make up? You're in luck! The stylists at your local groominn salons are committed to providing skilled haircuts like bobs, blunt cuts, layers, and more!
                                </p>
                            </div>
                        </div>
                        <div class="side-card d-flex align-items-start mt-4">
                            <div class="man-image me-4">
                                <img src="../assets/img/man.svg" class="img-fluid" alt="" />
                            </div>
                            <div class="text-area">
                                <h5 class="fw-bold text-orange">Men's Haircuts</h5>
                                <p class="text-color-2 small">
                                     The stylists at your local grominn salons are trained in a variety of men's haircuts. Whether you're looking for a fade, crew cut or just a trim, you can get the look you want at an affordable price at groominn salons. Want to make sure you get the same great cut.
                                </p>
                            </div>
                        </div>
                        <div class="side-card d-flex align-items-start mt-4">
                            <div class="man-image me-4">
                                <img src="../assets/img/man.svg" class="img-fluid" alt="" />
                            </div>
                            <div class="text-area">
                                <h5 class="fw-bold text-orange">Services for Seniors</h5>
                                <p class="text-color-2 small">
                                    At Groominn many Salons offers the same great beauty services for seniors. Whether your hair is thin, thick, colored, or natural, Our hair stylists know how to work with all hair types and textures. Don't forget to ask your stylist about a senior discount at your next service!
                                </p>
                            </div>
                        </div>
                    </div>
                </MDBCol>
            </MDBRow>
        </MDBContainer>
    </section>
    <!-- section 5 end -->
    <!-- section 6 -->
    <section style="padding-left:10%" class="section-6 py-5">
        <MDBContainer>
            <MDBRow class="align-items-center">
                <MDBCol col="6">
                    <div class="d-flex justify-content-end py-5">
                        <div class="boxes">
                            <div class="bg-white rounded-6 p-4 text-center white-box">
                                <div class="man-image mx-auto mb-4">
                                    <img src="../assets/img/salon.svg" class="img-fluid" alt="" />
                                </div>
                                <h4 class="fw-bold">Facial</h4>
                                <p class="small text-color-1">
                                    A facial is a family of skin care treatments for the face, including steam, exfoliation (physical and chemical), extraction, creams and lotions.
                                </p>
                            </div>
                            <div class="bg-white rounded-6 p-4 text-center white-box mt-4">
                                <div class="man-image mx-auto mb-4">
                                    <img src="../assets/img/spa.svg" class="img-fluid" alt="" />
                                </div>
                                <h4 class="fw-bold">SPA</h4>
                                <p class="small text-color-1">
                                    Spa treatments often include a combination of deep cleansing, massages and moisturisation.
                                </p>
                            </div>
                        </div>
                        <div class="boxes mt-4 ms-4">
                            <div class="bg-white rounded-6 p-4 text-center white-box">
                                <div class="man-image mx-auto mb-4">
                                    <img src="../assets/img/man.svg" class="img-fluid" alt="" />
                                </div>
                                <h4 class="fw-bold">Men's Hair Cut</h4>
                                <p class="small text-color-1">
                                    These are the coolest and most stylish men's haircuts. Show your barber one of these fresh new looks today.
                                </p>
                            </div>
                            <div class="bg-white rounded-6 p-4 text-center white-box mt-4">
                                <div class="man-image mx-auto mb-4">
                                    <img src="../assets/img/skincare.svg" class="img-fluid" alt="" />
                                </div>
                                <h4 class="fw-bold">Skin Care</h4>
                                <p class="small text-color-1">
                                    No matter what your skin type is, a daily skin care routine can help you maintain overall skin health and improve specific concerns like acne and dark spots
                                </p>
                            </div>
                        </div>
                    </div>
                </MDBCol>
                <MDBCol col="4">
                    <div class="ps-4">
                        <h2 class="fw-bold">Top Categories</h2>
                        <p class="small text-color-1">
                            Right now we have four top service categories.These are according to customer feedback and their services.You can checkin these services and get to know more about these services and the salons. 
                        </p>
                    </div>
                </MDBCol>
            </MDBRow>
        </MDBContainer>
    </section>
    <!-- section 6 end -->
    <!-- section 7 -->
    <section class="section-7 pt-5">
        <MDBContainer>
            <MDBRow class="align-items-center">
                <MDBCol col="4">
                    <h2 class="fw-bold">Groominn Applications</h2>
                    <p class="small text-color-1 mb-4">
                        You can download groominn application from your play store and book your require service any time you want. 
                    </p>
                    <MDBBtn class="bg-orange text-white text-capitalize shadow-0 f-w-400" size="md" rounded>
                        <MDBIcon iconStyle="fab" icon="apple" size="2xl" class="me-2"></MDBIcon>App store
                    </MDBBtn>
                    <MDBBtn class="bg-orange text-white text-capitalize shadow-0 ms-3 f-w-400" rounded>
                        <MDBIcon iconStyle="fab" icon="android" size="2xl" class="me-2"></MDBIcon>Play store
                    </MDBBtn>
                </MDBCol>
                <MDBCol col="8" class="text-center">
                    <img src="../assets/img/mobile.svg" class="img-fluid" alt="" />
                </MDBCol>
            </MDBRow>
        </MDBContainer>
    </section>
    <NoAuthModal :show="modalShow" @closeModal="modalShow = false" />
    <!-- section 7 end -->
</template>
<script setup>
import { ref } from "@vue/reactivity";
import { computed, onMounted, watchEffect } from "@vue/runtime-core";
import { MDBCarousel, MDBIcon } from "mdb-vue-ui-kit";
import NoAuthModal from "./modals/NoAuthModal.vue";
import { useRouter } from "vue-router";
import { useStore } from "vuex";
import Filters from "./custom-components/Filters.vue";

const carousel = ref(0);
const showAll = ref(false);
const modalShow = ref(false);
const rightSide = ref(null);
const imageHeight = ref(null);
const store = useStore();
const router = useRouter();

onMounted(() => {
    imageHeight.value = rightSide.value.clientHeight;
});

watchEffect(() => {
    store.dispatch('clientRedirection');
});

const items = [{
        src: "../images/banner-img-1.svg",
        alt: "...",
    },
    {
        src: "../images/banner-img-2.svg",
        alt: "...",
    },
    {
        src: "../images/banner-img-3.svg",
        alt: "...",
    },
];

const categories = ref([{
        title: "Beauty salons",
        image: "../images/salon.svg",
        bgColor: "#FFDED2",
        color: "#F05922",
    },
    {
        title: "SPA",
        image: "../images/spa.svg",
        bgColor: "#D3FFD2",
        color: "#33F82F",
    },
    {
        title: "Hair Dressers",
        image: "../assets/img/man.svg",
        bgColor: "#D7F8FF",
        color: "#22CBF0",
    },
    {
        title: "Yoga Centers",
        image: "../images/yoga.svg",
        bgColor: "#FFFACC",
        color: "#F9A500",
    },
    {
        title: "Massage centers",
        image: "../images/massage.svg",
        bgColor: "#FFDDDD",
        color: "#F02222",
    },
    {
        title: "Skin Cares",
        image: "../images/skincare.svg",
        bgColor: "#FDE9FF",
        color: "#E022F0",
    },
    {
        title: "Waxing Centers",
        image: "../images/wax.svg",
        bgColor: "#DDE0FF",
        color: "#0517BD",
    },
    {
        title: "Beauty salons",
        image: "../images/salon.svg",
        bgColor: "#FFDED2",
        color: "#F05922",
    },
    {
        title: "SPA",
        image: "../images/spa.svg",
        bgColor: "#D3FFD2",
        color: "#33F82F",
    },
    {
        title: "Hair Dressers",
        image: "../assets/img/man.svg",
        bgColor: "#D7F8FF",
        color: "#22CBF0",
    },
    {
        title: "Yoga Centers",
        image: "../images/yoga.svg",
        bgColor: "#FFFACC",
        color: "#F9A500",
    },
    {
        title: "Massage centers",
        image: "../images/massage.svg",
        bgColor: "#FFDDDD",
        color: "#F02222",
    },
    {
        title: "Skin Cares",
        image: "../images/skincare.svg",
        bgColor: "#FDE9FF",
        color: "#E022F0",
    },
    {
        title: "Waxing Centers",
        image: "../images/wax.svg",
        bgColor: "#DDE0FF",
        color: "#0517BD",
    },
]);

</script>
