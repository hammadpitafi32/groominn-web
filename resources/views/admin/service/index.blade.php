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
            --
            {{-- <a href="javascript:void(0);" class="btn {{($service->status?'btn-danger':'btn-success')}} btn-circle btn-sm changeStatus" data-id="{{$service->id}}" data-name="{{$service->name}}">
               <i class="fas {{($service->status?'fa-ban':'fa-check')}}"></i>
            </a> --}}
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
<div class="modal fade" id="modifyCategoryModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="userSubmit" action="{{route('create-user')}}">
                {{csrf_field()}}
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" placeholder="Enter Category Name" id="name" name="name" required="">
                        </div>
                    </div>
                    <input type="hidden" name="id" id="id">
                </div>
                <div class="modal-footer">
                    <p style="color: green;" id="Message"></p>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary modifyCategory">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('javascripts')

<script type="text/javascript">
    $(document).on('click', '.changeStatus', function() {
        // alert('s');
        id = $(this).data('id');
        data = {
            'id':id
        }
            
        axios.post("{{route('change-service-status')}}",
            data
        ).then(function(response) {
            // alert('dg');
            location.reload();
            // $('#modifyCategoryModel').modal('hide');
            toastr.success('Success!', "updated Successfully!", {"positionClass": "toast-bottom-right"});
        }).catch(function(error) {
            // console.log(error.response.data);
            // if (error && error.response) 
            // {
            //     $.each(error.response.data.errors, function(key, value){
            //         // console.log(key,value);
            //         $('#'+key).focus().addClass('border border-danger');
            //         $.each(value, function(key1, msg){
            //             $('#'+key).after('<span><small class="text-danger">'+msg+'</small><br></span>');
            //         });
            //     });
            // }
            

        });
    });
</script>
@endpush