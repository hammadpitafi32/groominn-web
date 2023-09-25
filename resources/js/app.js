require("./bootstrap");
import { createApp } from "vue";
import Toast, { POSITION } from "vue-toastification";
import VueTimepicker from "vue3-timepicker";
import "vue3-timepicker/dist/VueTimepicker.css";
import "vue-toastification/dist/index.css";
import "mdb-vue-ui-kit/css/mdb.min.css";
import vue3StarRatings from "vue3-star-ratings";
import {
    MDBContainer,
    MDBBtn,
    MDBCol,
    MDBRow,
    MDBCard,
    MDBCardImg,
    MDBCardBody,
    MDBCardTitle,
    MDBCardText,
    MDBIcon,
} from "mdb-vue-ui-kit";
import BtnLoader from "./components/custom-components/BtnLoader.vue";
import "./assets/css/style.css";
import App from "./App.vue";
import router from "./router/router";
import store from "./store";
import Vue3Geolocation from "vue3-geolocation";
import VueGoogleMaps from "@fawmi/vue-google-maps";
import VOtpInput from "vue3-otp-input";

const app = createApp({});

app.component("MDBContainer", MDBContainer);
app.component("MDBRow", MDBRow);
app.component("MDBCol", MDBCol);
app.component("MDBBtn", MDBBtn);
app.component("MDBCard", MDBCard);
app.component("MDBCardImg ", MDBCardImg);
app.component("MDBCardBody", MDBCardBody);
app.component("MDBCardTitle", MDBCardTitle);
app.component("MDBCardText", MDBCardText);
app.component("MDBIcon", MDBIcon);
app.component("BtnLoader", BtnLoader);
app.component('v-otp-input', VOtpInput)
app.component("vue3-star-ratings", vue3StarRatings);

app.use(store);
app.use(router);
// app.use(VueStarRating);
app.use(VueTimepicker);
app.use(Vue3Geolocation);
app.use(Toast, {
    position: POSITION.BOTTOM_RIGHT,
    timeout: 2000,
});
app.use(VueGoogleMaps, {
    load: {
        key: "AIzaSyB5rTgwoWfYM4wrSMsxihD6f0TECqfc3_0",
        libraries: "places",
    },
});


app.component("my-app", App).mount("#app");
