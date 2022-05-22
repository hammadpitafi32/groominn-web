@extends('layouts.admin')

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Tables</h1>
<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
<div class="card-header py-3 d-inline">
  <h6 class="m-0 font-weight-bold text-primary">Users</h6>
  <a href="#" class="btn btn-primary btn-icon-split float-right" data-toggle="modal" data-target="#modifyCategoryModel">
    <span class="icon text-white-50">
      <i class="fas fa-plus"></i>
    </span>
    <span class="text">Add Category</span>
  </a>
</div>
<div class="card-body">
  <div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <thead>
        <tr>
          <th>Action</th>
          <th>ID</th>
          <th>Name</th>
          <th>Total User Bind</th>
          <th>Created At</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th>Action</th>
          <th>ID</th>
          <th>Name</th>
          <th>Total User Bind</th>
          <th>Created At</th>
        </tr>
      </tfoot>
      <tbody>
        @foreach($categories as $category)
        <tr>
          <td>
            <a href="javascript:void(0);" class="btn btn-success btn-circle btn-sm editCategroyModal" data-id="{{$category->id}}" data-name="{{$category->name}}">
                <i class="fas fa-edit"></i>
            </a>
          </td>
          <td>{{$category->id}}</td>
          <td>{{$category->name}}</td>
          <td>{{$category->user_categories->count()}}</td>
          <td>{{$category->created_at}}</td>
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
    $(document).on('click', '.modifyCategory', function() {
        // alert('s');
        $('.form-control').removeClass('border border-danger');
        $('.form-control').next("span").remove();

        axios.post("{{route('create-category')}}",
            $('#userSubmit').serialize()
        ).then(function(response) {
            // alert('dg');
            location.reload();
            $('#modifyCategoryModel').modal('hide');
            toastr.success('Success!', "updated Successfully!", {"positionClass": "toast-bottom-right"});
        }).catch(function(error) {
            // console.log(error.response.data);
            if (error && error.response) 
            {
                $.each(error.response.data.errors, function(key, value){
                    // console.log(key,value);
                    $('#'+key).focus().addClass('border border-danger');
                    $.each(value, function(key1, msg){
                        $('#'+key).after('<span><small class="text-danger">'+msg+'</small><br></span>');
                    });
                });
            }
            

        });
    });

    $(document).on('click', '.editCategroyModal', function() {
        $('#name').val($(this).data('name'));
        $('#id').val($(this).data('id'));
        $('#modifyCategoryModel').modal('show');
    });
</script>
@endpush