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
                  v-model="credentials.name"
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
                  v-model="credentials.email"
                />
              </div>
            </MDBCol>
            <MDBCol col="12" class="pt-3">
              <div class="form-group">
                <label for="message" class="small mb-1 fw-500"
                  >How can we help you?</label
                >
                <textarea
                  v-model="credentials.message"
                  id=""
                  class="no-resize form-control border-0 bg-white"
                  placeholder="Type here......."
                  rows="7"

                ></textarea>
                <div class="mt-5 text-end">
                  <MDBBtn
                    @click="handleForm()"
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
     <!--  <div class="map-container">
        <div ref="map" class="google-map"></div>
      </div> -->
      <MDBCol col="col-12 col-md-6 second-col" class="mt-2">
        <!-- <Map :data="bookingList" /> -->
        <div ref="map" class="google-map"></div>
      </MDBCol>
    </MDBRow>
  </MDBContainer>
  <Footer />
</template>

<script setup>
import { ref, reactive} from "@vue/reactivity";
import Footer from "../layout/Footer.vue";
import { MDBInput } from "mdb-vue-ui-kit";
import Map from "./client/booking/Map.vue";
import { submitContactUs } from "../api";
import { useToast } from "vue-toastification";

const loading = ref(false);
const bookingList = ref(null);
// const showVeficationText = ref(false);
const credentials = reactive({
    email: "",
    name: "",
    message:"",
});

const toast = useToast();

const handleForm = () => {
 
    const formData = new FormData();
    formData.append("email", credentials.email);
    formData.append("name", credentials.name);
    formData.append("message", credentials.message);
    if (credentials.email && credentials.name &&  credentials.message) {
        loading.value = true;
        submitContactUs(formData)
            .then((res) => {
                apiResponse.value = res.data;
                toast.success("Your message has been sent successfully!");
                // store.dispatch("setLogin", res.data);
                store.dispatch("redirection");
            })
            .catch((error) => {
                let errorData = error.response.data;
                if (errorData.action_require) {
                    // showVeficationText.value = true;
                    console.log(errorData.data)
                    // userForVerify.email = errorData.data.email;
                    // userForVerify.phone = errorData.data.user_detail.phone;
                }
                toast.error(error.response.data.message, {
                    timeout: 2000,
                });
                apiResponse.value = error.response.data;
            })
            .finally(() => {
                loading.value = false;
            });
    }else{
      toast.error("Please fill the form properly");
    }
    
};
</script>

<script>
export default {
  data() {
    return {
      map: null,
      marker: null,
      coordinates: {
        lat: 31.4827, // Replace with your specific latitude
        lng: 74.2612, // Replace with your specific longitude
      },
    };
  },
  mounted() {
    // console.log('ooooooooo')
    this.initMap();
  },
  methods: {
    initMap() {
      // Load Google Maps API
      const apiKey = 'AIzaSyDoWPQ82mh0PFBOYhhHCK924wOffWOFSdc';
      const script = document.createElement('script');
      script.src = `https://maps.googleapis.com/maps/api/js?key=${apiKey}&callback=initMap`;
      script.async = true;
      script.defer = true;
      document.head.appendChild(script);

      // Create the map
      window.initMap = () => {
        this.map = new window.google.maps.Map(this.$refs.map, {
          center: this.coordinates,
          zoom: 12, // Adjust the zoom level as needed
        });

        // Add a marker
        this.marker = new window.google.maps.Marker({
          position: this.coordinates,
          map: this.map,
          title: 'Johar town Lahore Pakistan',
        });
      };
    },
  },
};
</script>

<style scoped>
.title {
  text-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
}
.send-btn{
    padding: .4rem 2.5rem;
}
.google-map {
  width: 100%;
  height: 400px;
}
</style>