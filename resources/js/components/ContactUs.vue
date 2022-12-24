<template>
  <section class="about-banner">
    <h3 class="fw-bold text-white">Contact Us</h3>
  </section>
  <MDBContainer class="my-5 pt-3 pb-5">
    <MDBRow>
      <MDBCol col="col-12 col-sm-6" class="mx-auto text-center">
        <h4 class="text-orange title fw-bold">Contact us</h4>
        <p class="small text-color-2 mt-3">
          For further questions, or any thing you want to ask, please
          email groominn@support.com or contact using our contact form.
        </p>
      </MDBCol>
    </MDBRow>
    <MDBRow>
    <MDBCol col="col-12 col-md-6" class="mt-2">
        <form action="" class="contact-form">
          <MDBRow>
            <MDBCol col="col-12 col-md-6 ">
              <div class="form-group ">
                <label for="name" class="small mb-1 fw-500">Name</label>
                <input
                  type="text"
                  id="name"
                  placeholder="Name"
                  class="form-control border-0 bg-white small py-2"
                />
              </div>
            </MDBCol>
            <MDBCol col="col-12 col-md-6 second-col">
              <div class="form-group">
                <label for="email" class="small mb-1 fw-500">Email</label>
                <input
                  type="email"
                  id="email"
                  placeholder="Email"
                  class="form-control border-0 bg-white small py-2"
                />
              </div>
            </MDBCol>
            <MDBCol col="12" class="pt-3">
              <div class="form-group">
                <label for="message" class="small mb-1 fw-500"
                  >How can we help you?</label
                >
                <textarea
                  name=""
                  id=""
                  class="no-resize form-control border-0 bg-white"
                  placeholder="Type here......."
                  rows="7"
                ></textarea>
                <div class="mt-5 text-end">
                  <MDBBtn
                    class="
                      bg-orange
                      text-white
                      shadow-0
                      rounded-5
                      send-btn
                      text-capitalize
                    "
                    >Send</MDBBtn
                  >
                </div>
              </div>
            </MDBCol>
          </MDBRow>
        </form>
      </MDBCol>
      <MDBCol col="col-12 col-md-6 second-col" class="mt-2">
        <Map :data="bookingList" />
      </MDBCol>
    </MDBRow>
  </MDBContainer>
  <Footer />
</template>

<script setup>
import { ref } from "@vue/reactivity";
import Footer from "../layout/Footer.vue";
import { MDBInput } from "mdb-vue-ui-kit";
import Map from "./client/booking/Map.vue";

const bookingList = ref(null);
</script>

<style scoped>
.title {
  text-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
}
.send-btn{
    padding: .4rem 2.5rem;
}
</style>