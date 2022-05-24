<template>
  <!-- section 1 -->
  <section class="banner-section">
    <MDBContainer fluid class="p-0 position-relative">
      <MDBCarousel
        v-model="carousel"
        fade
        :items="items"
        :pause="false"
        :interval="4000"
        itemsClass="slider-image img-fluid"
        class="main-slider"
      />
      <div class="text-on-slider">
        <h2 class="fw-bold">
          Connecting to you salons
          <span class="text-orange d-block">in your area</span>
        </h2>
        <p class="small">
          Grooming is here to book an Appointment for you without <br />
          making a call
        </p>
        <MDBBtn class="bg-orange text-white text-capitalize"
           @click="store.state.auth ? router.push('/booking-list') : modalShow = true">Get Started</MDBBtn
        >
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
          <img
            src="../assets/img/pnik-grooming.svg"
            class="img-fluid"
            alt=""
            :style="{ height: imageHeight + 'px' }"
          />
        </MDBCol>
        <MDBCol col="10">
          <div ref="rightSide">
            <MDBRow>
              <MDBCol col="10" class="mx-auto text-center">
                <h2 class="text-orange fw-bold mb-3">Why choose Grooming?</h2>
                <p class="text-color-1 small">
                  The digital era is fully upon us and the internet is
                  completely changing the way that we live and do business.
                  ImTools is here to help you bring your business into the
                  digital era in the most cost effective way possible.
                </p>
              </MDBCol>
            </MDBRow>
            <MDBRow class="mt-5">
              <MDBCol col="4">
                <div class="text-center h-100">
                  <MDBCard class="shadow-2 features-card h-100 pt-4">
                    <img
                      src="../assets/img/fast-easy-booking.svg"
                      alt="..."
                      class="img-fluid"
                    />
                    <MDBCardBody class="mt-4">
                      <MDBCardTitle class="mb-4"
                        >Fast & Easy Booking</MDBCardTitle
                      >
                      <MDBCardText class="text-color-1 small">
                        Whether you’re brand new to digital marketing, or a
                        seasoned veteran – We’re here to help you shift your
                        dreams of running an online empire into a reality.
                      </MDBCardText>
                    </MDBCardBody>
                  </MDBCard>
                </div>
              </MDBCol>
              <MDBCol col="4">
                <div class="text-center h-100 bg-after-orange">
                  <MDBCard class="shadow-4-strong features-card h-100 pt-4">
                    <img
                      src="../assets/img/save-time.svg"
                      alt="..."
                      class="img-fluid"
                    />
                    <MDBCardBody class="mt-4">
                      <MDBCardTitle class="mb-4">Save time</MDBCardTitle>
                      <MDBCardText class="text-color-1 small">
                        Let’s face it – Starting a business can be expensive and
                        frustrating if you don’t know what you are doing.
                        ImTools can provide software and marketing tools for
                        your business that are designed to fit any budget.
                      </MDBCardText>
                    </MDBCardBody>
                  </MDBCard>
                </div>
              </MDBCol>
              <MDBCol col="4">
                <div class="text-center h-100">
                  <div class="text-center h-100">
                    <MDBCard class="shadow-2 features-card h-100 pt-4">
                      <img
                        src="../assets/img/satisfied-customer.svg"
                        alt="..."
                        class="img-fluid"
                      />
                      <MDBCardBody class="mt-4">
                        <MDBCardTitle class="mb-4"
                          >Satisfied coustomers</MDBCardTitle
                        >
                        <MDBCardText class="text-color-1 small">
                          ImTools will quickly become your go to source for new
                          marketing training and software releases. We think
                          you’ll love it as much as we do.
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
                    <MDBBtn
                      class="btn-custom-white shadow-0 text-capitalize"
                      @click="showAll = !showAll"
                    >
                      {{
                        showAll ? "Show Less catagories" : "Show All catagories"
                      }}
                    </MDBBtn>
                  </MDBCol>
                </MDBRow>
                <MDBRow>
                  <MDBCol col="12 pt-5">
                    <div
                      class="category-boxes d-flex pb-5"
                      :class="showAll && 'flex-wrap'"
                    >
                      <div
                        v-for="(category, index) in categories"
                        :key="index"
                        class="category-box bg-white rounded-6 p-3 me-3 mb-3"
                      >
                        <div
                          class="man-image"
                          :style="{ backgroundColor: category.bgColor }"
                        >
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
          <div
            class="
              orange-background
              d-flex
              align-items-center
              justify-content-end
              pe-5
            "
          >
            <img
              src="../assets/img/girl.svg"
              alt=""
              class="img-fluid girl-img w-75"
            />
            <img src="../assets/img/map.svg" alt="" class="img-fluid w-25" />
          </div>
          <div class="text-box position-absolute text-center">
            <img src="../assets/img/logo-2.svg" class="img-fluid" alt="" />
            <small class="text-dark d-block mt-3"
              >Lorem Ipsum is simply dumm text of the prin ting and</small
            >
          </div>
        </MDBCol>
        <MDBCol col="6">
          <div class="right-side position-relative pt-5">
            <h2 class="fw-bold">Lorem Ipsum</h2>
            <p class="text-color-2 small">
              Lorem Ipsum is simply dummy text of the printing and typesetting
              industry.Lorem Ipsum has been the industry's standard dummy text
              ever since the 1500s, when an unknown
            </p>

            <div class="side-card d-flex align-items-start mt-4 pt-3">
              <div class="man-image me-4">
                <img src="../assets/img/man.svg" class="img-fluid" alt="" />
              </div>
              <div class="text-area">
                <h5 class="fw-bold text-orange">Lorem ispum</h5>
                <p class="text-color-2 small">
                  Lorem Ipsum is simply dummy text of the printing and
                  typesetting industry.Lorem Ipsum has been the industry's
                  standard dummy text ever since the 1500s, when an unknown
                </p>
              </div>
            </div>
            <div class="side-card d-flex align-items-start mt-4">
              <div class="man-image me-4">
                <img src="../assets/img/man.svg" class="img-fluid" alt="" />
              </div>
              <div class="text-area">
                <h5 class="fw-bold text-orange">Lorem ispum</h5>
                <p class="text-color-2 small">
                  Lorem Ipsum is simply dummy text of the printing and
                  typesetting industry.Lorem Ipsum has been the industry's
                  standard dummy text ever since the 1500s, when an unknown
                </p>
              </div>
            </div>
            <div class="side-card d-flex align-items-start mt-4">
              <div class="man-image me-4">
                <img src="../assets/img/man.svg" class="img-fluid" alt="" />
              </div>
              <div class="text-area">
                <h5 class="fw-bold text-orange">Lorem ispum</h5>
                <p class="text-color-2 small">
                  Lorem Ipsum is simply dummy text of the printing and
                  typesetting industry.Lorem Ipsum has been the industry's
                  standard dummy text ever since the 1500s, when an unknown
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
  <section class="section-6 py-5">
    <MDBContainer>
      <MDBRow class="align-items-center">
        <MDBCol col="6">
          <div class="d-flex justify-content-end py-5">
            <div class="boxes">
              <div class="bg-white rounded-6 p-4 text-center white-box">
                <div class="man-image mx-auto mb-4">
                  <img src="../assets/img/man.svg" class="img-fluid" alt="" />
                </div>
                <h4 class="fw-bold">Lorem ispum</h4>
                <p class="small text-color-1">
                  Lorem Ipsum is simply dummy text of the printing and
                  typesetting
                </p>
              </div>
              <div class="bg-white rounded-6 p-4 text-center white-box mt-4">
                <div class="man-image mx-auto mb-4">
                  <img src="../assets/img/man.svg" class="img-fluid" alt="" />
                </div>
                <h4 class="fw-bold">Lorem ispum</h4>
                <p class="small text-color-1">
                  Lorem Ipsum is simply dummy text of the printing and
                  typesetting
                </p>
              </div>
            </div>
            <div class="boxes mt-4 ms-4">
              <div class="bg-white rounded-6 p-4 text-center white-box">
                <div class="man-image mx-auto mb-4">
                  <img src="../assets/img/man.svg" class="img-fluid" alt="" />
                </div>
                <h4 class="fw-bold">Lorem ispum</h4>
                <p class="small text-color-1">
                  Lorem Ipsum is simply dummy text of the printing and
                  typesetting
                </p>
              </div>
              <div class="bg-white rounded-6 p-4 text-center white-box mt-4">
                <div class="man-image mx-auto mb-4">
                  <img src="../assets/img/man.svg" class="img-fluid" alt="" />
                </div>
                <h4 class="fw-bold">Lorem ispum</h4>
                <p class="small text-color-1">
                  Lorem Ipsum is simply dummy text of the printing and
                  typesetting
                </p>
              </div>
            </div>
          </div>
        </MDBCol>
        <MDBCol col="4">
          <div class="ps-4">
            <h2 class="fw-bold">Lorem ispum</h2>
            <p class="small text-color-1">
              Lorem Ipsum is simply dummy text of the printing and typesetting
              industry.Lorem Ipsum has been the industry's standard dummy text
              ever since the 1500s, when an unknown
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
          <h2 class="fw-bold">Lorem ispum</h2>
          <p class="small text-color-1 mb-4">
            Lorem Ipsum is simply dummy text of the printing and typesetting
            industry.Lorem Ipsum has been the industry's standard dummy text
            ever since the 1500s, when an unknown
          </p>
          <MDBBtn
            class="bg-orange text-white text-capitalize shadow-0 f-w-400"
            size="md"
            rounded
          >
            <MDBIcon
              iconStyle="fab"
              icon="apple"
              size="2xl"
              class="me-2"
            ></MDBIcon
            >App store
          </MDBBtn>

          <MDBBtn
            class="bg-orange text-white text-capitalize shadow-0 ms-3 f-w-400"
            rounded
          >
            <MDBIcon
              iconStyle="fab"
              icon="android"
              size="2xl"
              class="me-2"
            ></MDBIcon
            >Play store
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
import { onMounted, watchEffect } from "@vue/runtime-core";
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
  if(store.state.role == 'Provider'){
    router.push('/my-shop')
  }
})

const items = [
  {
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

const categories = ref([
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