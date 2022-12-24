@extends('layouts.admin')

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Services</h1>
<p class="mb-4">Here You can active or not active user services</a>.</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
<div class="card-header py-3 d-inline">
  <h6 class="m-0 font-weight-bold text-primary">Services</h6>
</div>
<div class="card-body">
  <div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <thead>
        <tr>
          <th>Action</th>
          <th>Name</th>
          <th>Service By</th>
          <th>Status</th>
          <th>Created At</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th>Action</th>
          <th>Name</th>
          <th>Service By</th>
          <th>Status</th>
          <th>Created At</th>
        </tr>
      </tfoot>
      <tbody>
        @foreach($services as $service)
        <tr>
          <td>
            <a href="javascript:void(0);" class="btn btn-success btn-circle btn-sm editServiceModal" data-id="{{$service->id}}" data-name="{{$service->name}}" data-duration="{{$service->business_service->duration}}" data-charges="{{$service->business_service->charges}}" data-category="{{$service->business_service->user_category->category_id}}">
                <i class="fas fa-edit"></i>
            </a>
            | <a href="javascript:void(0);" class="btn btn-danger btn-circle btn-sm deleteService" data-id="{{$service->id}}">
                <i class="fas fa-trash"></i>
            </a>
          </td>
          <td>{{$service->name}}</td>
          <td>{{$service->user->name}}</td>
          <td>{{$service->status}}</td>
          <td>{{$service->created_at}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
</div>

{{-- models here --}}
<div class="modal fade" id="modifyServiceModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Service</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="userSubmit" action="{{route('update-service')}}">
                {{csrf_field()}}
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="name">Servic Name</label>
                            <input type="text" class="form-control" placeholder="Enter Category Name" id="name" name="name" required="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="name">Category</label>
                            <select id="add-cat" name="category" class="form-control form-select text-capitalize" data-v-4a7ccec8="">
                              <option value="" data-v-4a7ccec8="">Select Category</option>
                              @foreach($categories as $cat)
                              <option class="text-capitalize" value="{{$cat->id}}" data-v-4a7ccec8="">{{$cat->name}}</option>
                              @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="duration">Duration</label>
                            <input type="time" class="form-control" placeholder="Enter duration" id="duration" name="duration" required="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="charges">Charges</label>
                            <input type="number" class="form-control" placeholder="Enter charges" id="charges" name="charges" required="">
                        </div>
                    </div>
                    <input type="hidden" name="id" id="id">
                </div>
                <div class="modal-footer">
                    <p style="color: green;" id="Message"></p>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary modifyCategory">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('javascripts')

<script type="text/javascript">
    $(document).on('click', '.changeStatus', function() {
       
        id = $(this).data('id');
        data = {
            'id':id
        }
            
        axios.post("{{route('change-service-status')}}",
            data
        ).then(function(response) {
            
            location.reload();
           
            toastr.success('Success!', "updated Successfully!", {"positionClass": "toast-bottom-right"});
        }).catch(function(error) {
          

        });
    });
    $(document).on('click', '.editServiceModal', function() {
        // console.log($(this).data('category'))
        $('#add-cat').val($(this).data('category'));
        $('#duration').val($(this).data('duration'));
        $('#charges').val($(this).data('charges'));
        $('#name').val($(this).data('name'));
        $('#id').val($(this).data('id'));
        $('#modifyServiceModel').modal('show');
    });
    $(document).on('click', '.deleteService', function() {
        

        id = $(this).data('id');
        data = {
            'id':id
        }
       swal({
          title: "Are you sure?",
          text: "You will not be able to recover this data!",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: '#DD6B55',
          confirmButtonText: 'Yes, I am sure!',
          cancelButtonText: "No, cancel it!",
          closeOnConfirm: false,
          closeOnCancel: false
       },
       function(isConfirm){

        if (isConfirm){
          axios.post("{{route('delete-service')}}",
              data
          ).then(function(response) {
              location.reload();
              toastr.success('Success!', "updated Successfully!", {"positionClass": "toast-bottom-right"});



          }).catch(function(error) {

            toastr.error('Error!', "some thing went wrong!", {"positionClass": "toast-bottom-right"});
          });
           // swal("Shortlisted!", "Candidates are successfully shortlisted!", "success");

          } else {
            swal("Cancelled", "Your data is safe :)", "error");
               
          }
       });
            
 
    });
</script>
@endpush