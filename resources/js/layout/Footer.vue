<template>
  <footer class="footer">
    <div class="footer-items border-bottom">
      <MDBContainer class="pt-5 mt-4">
        <MDBRow>
          <MDBCol col="12 col-sm-4">
            <img src="../assets/img/logo.svg" class="img-fluid" alt="" />
            <p class="small text-color-1 mt-3">
              Groominn connecting the customers with beauty salons to get bookings near the customer.On other hand customers can check the price and services of salon's what they are offering.By just one click customer can book the service and get the wait estimation time.
            </p>
          </MDBCol>
          <MDBCol col="5 col-sm-4">
            <div class="w-fit-content mx-auto footer-links margin-none">
              <h6 class="fw-bold text-color-2 mb-3 heading-footer">Quick links</h6>
              <ul class="list-unstyled">
                <li><router-link to="/about-us" class="nav-link">About</router-link></li>
                <li><router-link to="/terms-policy" class="nav-link">Terms & policy</router-link></li>
                <!-- <li><a href="#" class="link">Privacy</a></li> -->
                <!-- <li><a href="#" class="link">Affiliates</a></li> -->
                <li><router-link to="/contact-us" class="nav-link">Contact Support</router-link>
                  <!-- <a href="{{url('contact-us')}}" class="link">Contact Support</a> -->
                </li>
              </ul>
            </div>
          </MDBCol>
          <MDBCol col="7 col-sm-4" class="text-center">
            <h6 class="fw-bold text-color-2 heading-footer">Scan QR to download app</h6>
            <img src="../assets/img/qrcode.svg" class="img-fluid mt-4" alt="">
          </MDBCol>
        </MDBRow>
      </MDBContainer>
    </div>

    <div class="text-center py-4">
      <p class="small text-color-1 mb-0">2022 all rights reserved by @Groominn</p>
    </div>
  </footer>
</template>

<script setup>
</script>
