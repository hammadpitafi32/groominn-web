@extends('layouts.admin')

@section('content')
<!-- Page Heading -->
<!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
<div class="card-header py-3 d-inline">
  <h6 class="m-0 font-weight-bold text-primary">Notifications</h6>
 <!--  <a href="#" class="btn btn-primary btn-icon-split float-right" data-toggle="modal" data-target="#modifyTypeModel">
    <span class="icon text-white-50">
      <i class="fas fa-plus"></i>
    </span>
    <span class="text">Add Business Type</span>
  </a> -->
</div>
<div class="card-body">
  <div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <thead>
        <tr>
          <th>Action</th>
          <th>Type</th>
          <th>From User</th>
          <th>To User</th>
          <th>Message</th>
          <th>Status</th>
          <th>Seen</th>
          <th>Created At</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th>Action</th>
          <th>Type</th>
          <th>From User</th>
          <th>To User</th>
          <th>Message</th>
          <th>Status</th>
          <th>Seen</th>
          <th>Created At</th>
        </tr>
      </tfoot>
      <tbody>
        @foreach($notifications as $notification)

        <tr>
          <td>
         
            <a href="javascript:void(0);" class="btn btn-danger btn-circle btn-sm deleteType" data-id="{{$notification->id}}">
                <i class="fas fa-trash"></i>
            </a>
            
          </td>
          <td>{{$notification->type}}</td>
          <td>{{$notification->fromUser->name}}</td>
          <td>{{$notification->toUser->name}}</td>
          <td>{{$notification->data}}</td>
          <td>{{$notification->status}}</td>
          <td>{{$notification->seen==1?"Yes":"No"}}</td>
          <td>{{$notification->created_at}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
</div>


@endsection
@push('javascripts')

<script type="text/javascript">


    $(document).on('click', '.deleteType', function() {
      
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
          axios.post("{{route('delete-notification')}}",
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