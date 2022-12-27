@extends('layouts.admin')

@section('content')

<!-- DataTales Example -->
<div class="card shadow mb-4">
<div class="card-header py-3 d-inline">
  <h6 class="m-0 font-weight-bold text-primary">Bookings</h6>

</div>
<div class="card-body">
  <div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <thead>
        <tr>
          <th>Action</th>
          <th>Booking No</th>
          <th>User</th>
          <th>Charges</th>
          <th>Status</th>
          <th>Created At</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th>Action</th>
          <th>Booking No</th>
          <th>User</th>
          <th>Charges</th>
          <th>Status</th>
          <th>Created At</th>
        </tr>
      </tfoot>
      <tbody>
        @foreach($bookings as $booking)
        <tr>
          <td>
            <a href="javascript:void(0);" class="btn btn-primary btn-circle btn-sm editBookingModal"data-booking="{{$booking->booking_no}}" data-user="{{$booking->user->name}}" data-charges="{{$booking->charges}}" data-status="{{$booking->status}}" data-provider="{{$booking->user_business->user->name}}" data-created="{{$booking->created_at}}">
                <i class="fas fa-eye"></i>
            </a>
            | <a href="javascript:void(0);" class="btn btn-danger btn-circle btn-sm deleteBooking" data-id="{{$booking->id}}">
                <i class="fas fa-trash"></i>
            </a>
            | <a href="javascript:void(0);" class="btn btn-success btn-circle btn-sm editStatus" data-id="{{$booking->id}}" data-status="{{$booking->status}}">
                <i class="fas fa-edit"></i>
            </a>
          </td>
          <td>{{$booking->booking_no}}</td>
          <td>{{$booking->user->name}}</td>
          <td>{{$booking->charges}}</td>
          <td>{{$booking->status}}</td>
          <td>{{$booking->created_at}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
</div>

{{-- models here --}}
<div class="modal fade" id="modifyBookingModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Booking</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
           
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="first_name">Booking No</label>
                            <input type="text" class="form-control" id="booking_no" readonly>
                        </div>
 
                    </div>
                    <div class="form-row">
 
                        <div class="form-group col">
                            <label for="last_name">User</label>
                            <input type="text" class="form-control" id="user" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Provider</label>
                            <input type="text" class="form-control" id="provider" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Charges</label>
                            <input type="number" class="form-control" id="charges" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Status</label>
                            <input type="text" class="form-control" id="status"  readonly>
                        </div>
                     
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Created</label>
                            <input type="text" class="form-control" id="created"  readonly>
                        </div>
                     
                    </div>
     
                </div>
                <div class="modal-footer">
                    <p style="color: green;" id="Message"></p>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    
                </div>
           
        </div>
    </div>
</div>
{{-- models here --}}

<div class="modal fade" id="modifyStatusModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Booking Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="bookingSubmit" action="{{route('update-booking-status')}}">
                <input type="hidden"  id="id" name="id">
                {{csrf_field()}}
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Status</label>
                            <select class="form-control selectpicker" id="status" title="Choose Following..." required="" name="status" data-actions-box="true" data-live-search="true" required="">
                                @foreach($status as $val => $key)
                                <option value="{{$key}}">{{$key}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <p style="color: green;" id="Message"></p>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary modifyStatus">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('javascripts')

<script type="text/javascript">
    var isEdditMode=false;
    $(document).on('click', '.modifyStatus', function() {
        // alert('s');
        $('.form-control').removeClass('border border-danger');
        $('.form-control').next("span").remove();
        
        var url="{{route('update-booking-status')}}";

        axios.post(url,
            $('#bookingSubmit').serialize()
        ).then(function(response) {
            
            $('#modifyStatusModel').modal('hide');
           
            swal("Updated!", "Status updated successfully!", "success");
            location.reload();
        }).catch(function(error) {
            // console.log(error);
            $.each(error.response.data.errors, function(key, value){
                // console.log(key,value);
                $('#'+key).focus().addClass('border border-danger');
                $.each(value, function(key1, msg){
                    $('#'+key).after('<span><small class="text-danger">'+msg+'</small><br></span>');
                });
            });

        });
    });
    $(document).on('click', '.changeStatus', function() {
        // alert('s');
        id = $(this).data('id');
        data = {
            'id':id
        }
            
        axios.post("{{route('change-user-status')}}",
            data
        ).then(function(response) {
           
            location.reload();
           
            toastr.success('Success!', "updated Successfully!", {"positionClass": "toast-bottom-right"});
        }).catch(function(error) {
          
        });
    });
    $(document).on('click', '.editBookingModal', function() {
       
        $('#booking_no').val($(this).data('booking'));
        $('#user').val($(this).data('user'));
        $('#provider').val($(this).data('provider'));
        $('#status').val($(this).data('status'));
        $('#charges').val($(this).data('charges'));
        $('#created').val($(this).data('created'));
        $('#modifyBookingModel').modal('show');
    });

    $(document).on('click', '.editStatus', function() {
       
        $('#id').val($(this).data('id'));
        $('#status').val($(this).data('status'));
        $('#modifyStatusModel').modal('show');
    });
    $(document).on('click', '.deleteBooking', function() {
        

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
          axios.post("{{route('delete-booking')}}",
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