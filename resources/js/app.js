require('./bootstrap');
import { createApp } from 'vue'
import 'mdb-vue-ui-kit/css/mdb.min.css';
import { MDBContainer, MDBBtn, MDBCol, MDBRow, MDBCard, MDBCardImg, MDBCardBody, MDBCardTitle, MDBCardText, MDBIcon } from 'mdb-vue-ui-kit';
import './assets/css/style.css';
import App from './App.vue';
import router from './router/router';

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
app.component('my-app', App).mount('#app');