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
                <MDBInput id="name" class="bg-white py-2" />
              </div>
              <div class="form-group mb-3">
                <label for="address" class="mb-2 fw-bold small">Address</label>
                <MDBInput id="address" class="bg-white py-2" />
              </div>
              <div class="form-group mb-3">
                <label for="description" class="mb-2 fw-bold small"
                  >Description</label
                >
                <MDBTextarea
                  rows="5"
                  id="description"
                  class="bg-white py-2 no-resize"
                />
              </div>
              <MDBRow>
                <MDBCol col="3">
                  <div class="mb-2 fw-bold small">
                    Upload shop Photos (Optional)
                  </div>
                  <label for="shop-pics" class="custom-drag-label">
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
                    <span class="ms-2">Drag & drop your file here</span>
                  </label>
                  <MDBFile id="shop-pics" class="mb-2 custom-file-type" />
                </MDBCol>
                <MDBCol col="3">
                  <div class="mb-2 fw-bold small">Upload CNIC Front</div>
                  <label for="cnic-front" class="custom-drag-label">
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
                    <span class="ms-2">Drag & drop your file here</span>
                  </label>
                  <MDBFile id="cnic-front" class="mb-2 custom-file-type" />
                </MDBCol>
                <MDBCol col="3">
                  <div class="mb-2 fw-bold small">Upload CNIC Back</div>
                  <label for="cnic-back" class="custom-drag-label">
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
                    <span class="ms-2">Drag & drop your file here</span>
                  </label>
                  <MDBFile id="cnic-back" class="mb-2 custom-file-type" />
                </MDBCol>
                <MDBCol col="3">
                  <div class="mb-2 fw-bold small">Shop Liscence</div>
                  <label for="shop-liscence" class="custom-drag-label">
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
                    <span class="ms-2">Drag & drop your file here</span>
                  </label>
                  <MDBFile id="shop-liscence" class="mb-2 custom-file-type" />
                </MDBCol>
              </MDBRow>
              <MDBRow class="mt-5">
                <MDBCol col="12" class="text-end pt-4">
                  <MDBBtn
                    class="
                      text-white
                      bg-light-grey
                      shadow-0
                      text-capitalize
                      px-5
                      rounded-4
                    "
                  >
                    Cancel
                  </MDBBtn>
                  <MDBBtn
                    class="
                      text-white
                      bg-orange
                      shadow-0
                      text-capitalize
                      px-5
                      rounded-4
                      ms-3
                    "
                  >
                    Add shop
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
import { MDBInput, MDBTextarea, MDBFile } from "mdb-vue-ui-kit";
</script>