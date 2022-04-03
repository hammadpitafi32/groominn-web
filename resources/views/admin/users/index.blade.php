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
          <td>--</td>
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
                            <label for="name">Name</label>
                            <input type="text" class="form-control" placeholder="Enter Full Name" id="name" name="name" required="">
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
                            <label for="password">Password</label>
                            <input type="text" class="form-control" placeholder="Enter Password" id="password" name="password" required="">
                        </div>
                        <div class="form-group col">
                            <label for="confirm_password">Confirm Password</label>
                            <input type="text" class="form-control" placeholder="Enter Confirm Password" id="confirm_password" name="confirm_password" required="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Role</label>
                            <select class="form-control selectpicker" id="role_id" title="Choose Following..." required="" name="role_id" data-actions-box="true" data-live-search="true" required="">
                                @foreach($roles as $role)
                                <option value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <p style="color: green;" id="Message"></p>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary modifyUrl">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
