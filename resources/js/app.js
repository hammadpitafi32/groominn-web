require('./bootstrap');
import { createApp } from 'vue'
import Toast, { POSITION } from "vue-toastification";
import VueTimepicker from 'vue3-timepicker'
import 'vue3-timepicker/dist/VueTimepicker.css'
import "vue-toastification/dist/index.css";
import 'mdb-vue-ui-kit/css/mdb.min.css';
import { MDBContainer, MDBBtn, MDBCol, MDBRow, MDBCard, MDBCardImg, MDBCardBody, MDBCardTitle, MDBCardText, MDBIcon } from 'mdb-vue-ui-kit';
import './assets/css/style.css';
import App from './App.vue';
import router from './router/router';
import store from './store';
import Vue3Geolocation from 'vue3-geolocation';

const app = createApp({});

app.component('MDBContainer', MDBContainer);
app.component('MDBRow', MDBRow);
app.component('MDBCol', MDBCol);
app.component('MDBBtn', MDBBtn);
app.component('MDBCard', MDBCard);
app.component('MDBCardImg ', MDBCardImg);
app.component('MDBCardBody', MDBCardBody);
app.component('MDBCardTitle', MDBCardTitle);
app.component('MDBCardText', MDBCardText);
app.component('MDBIcon', MDBIcon);


app.use(router);
app.use(store);
app.use(VueTimepicker);
app.use(Vue3Geolocation);
app.use(Toast, {
    position: POSITION.TOP_RIGHT,
    timeout: 2000
});
app.component('my-app', App).mount('#app');