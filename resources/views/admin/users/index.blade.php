@extends('layouts.admin')

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Tables</h1>
<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
<div class="card-header py-3 d-inline">
  <h6 class="m-0 font-weight-bold text-primary">Users</h6>
  <a href="#" class="btn btn-primary btn-icon-split float-right" data-toggle="modal" data-target="#modifyUserModel">
    <span class="icon text-white-50">
      <i class="fas fa-plus"></i>
    </span>
    <span class="text">Add User</span>
  </a>
</div>
<div class="card-body">
  <div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <thead>
        <tr>
          <th>Action</th>
          <th>Name</th>
          <th>Email</th>
          <th>Role</th>
          <th>Created At</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th>Action</th>
          <th>Name</th>
          <th>Position</th>
          <th>Office</th>
          <th>Created At</th>
        </tr>
      </tfoot>
      <tbody>
        @foreach($users as $user)
        <tr>
          <td>
            <a href="javascript:void(0);" class="btn {{($user->status?'btn-danger':'btn-success')}} btn-circle btn-sm changeStatus" data-id="{{$user->id}}" data-name="{{$user->name}}">
                <i class="fas {{($user->status?'fa-ban':'fa-check')}}"></i>
             </a>
          </td>
          <td>{{$user->name}}</td>
          <td>{{$user->email}}</td>
          <td>{{$user->role->name}}</td>
          <td>{{$user->created_at}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
</div>

{{-- models here --}}
<div class="modal fade" id="modifyUserModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="userSubmit" action="{{route('create-user')}}">
                {{csrf_field()}}
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="name">First Name</label>
                            <input type="text" class="form-control" placeholder="Enter First Name" id="first_name" name="first_name" required="">
                        </div>
                        <div class="form-group col">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" placeholder="Enter Last Name" id="last_name" name="last_name" required="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" placeholder="Enter email" id="email" name="email" required="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" placeholder="Enter phone" id="phone" name="phone" required="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="password">Password</label>
                            <input type="text" class="form-control" placeholder="Enter Password" id="password" name="password" required="">
                        </div>
                        <div class="form-group col">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="text" class="form-control" placeholder="Enter Confirm Password" id="password_confirmation" name="password_confirmation" required="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Role</label>
                            <select class="form-control selectpicker" id="role" title="Choose Following..." required="" name="role" data-actions-box="true" data-live-search="true" required="">
                                @foreach($roles as $role)
                                <option value="{{$role->name}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <p style="color: green;" id="Message"></p>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary modifyUser">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('javascripts')

<script type="text/javascript">
    $(document).on('click', '.modifyUser', function() {
        // alert('s');
        $('.form-control').removeClass('border border-danger');
        $('.form-control').next("span").remove();

        axios.post("{{route('create-user')}}",
            $('#userSubmit').serialize()
        ).then(function(response) {

            $('#modifyUserModel').modal('hide');
            toastr.success('Success!', "updated Successfully!", {"positionClass": "toast-bottom-right"});
            
        }).catch(function(error) {
            // console.log(error.response.data);
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