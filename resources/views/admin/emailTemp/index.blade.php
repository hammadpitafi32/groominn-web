@extends('layouts.admin')

@section('content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
<div class="card-header py-3 d-inline">
  <h6 class="m-0 font-weight-bold text-primary">Email Templates</h6>
  <a href="#" class="btn btn-primary btn-icon-split float-right" data-toggle="modal" data-target="#modifyemailModel">
    <span class="icon text-white-50">
      <i class="fas fa-plus"></i>
    </span>
    <span class="text">New Template</span>
  </a>
</div>
<div class="card-body">
  <div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <thead>
        <tr>
          <th>Action</th>
          <th>Title</th>
          <th>Created by</th>
          <th>Created At</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th>Action</th>
          <th>Title</th>
          <th>Created by</th>
          <th>Created At</th>
        </tr>
      </tfoot>
      <tbody>
        @foreach($emails as $email)
        <tr>
          <td>
            <a href="javascript:void(0);" class="btn btn-success btn-circle btn-sm editTempModal" data-id="{{$email->id}}" data-title="{{$email->title}}" data-content="{{$email->content}}">
                <i class="fas fa-edit"></i>
            </a>
            | <a href="javascript:void(0);" class="btn btn-danger btn-circle btn-sm deleteTemp" data-id="{{$email->id}}">
                <i class="fas fa-trash"></i>
            </a>
   
          </td>
          <td>{{$email->title}}</td>
          <td>{{$email->user->name}}</td>
          <td>{{$email->created_at}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
</div>

{{-- models here --}}
<div class="modal fade" id="modifyemailModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Email Template</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="emailSubmit" action="{{route('create-user')}}">
                <input type="hidden" id="id" name="id">
                {{csrf_field()}}
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" placeholder="Title" id="title" name="title" required="">
                        </div>
                        
                    </div>
                    <div class="form-row">
   
                        <div class="form-group col-md-12">
                            <label for="summernote">Content</label>
                            <textarea id="summernote" name="content"></textarea>
                        </div>
                    </div>
 
                </div>
                <div class="modal-footer">
                    <p style="color: green;" id="Message"></p>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary modifyTemp">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('javascripts')

<script type="text/javascript">
    
    var isEdditMode=false;

    $(document).on('click', '.modifyTemp', function() {
       
        $('.form-control').removeClass('border border-danger');
        $('.form-control').next("span").remove();
        
        var url="{{route('create-template')}}";
        
        if(isEdditMode){
           url="{{route('update-template')}}";
        }
        // var text = $('#summernote').summernote('code');
        // console.log(text)
        axios.post(url,
            $('#emailSubmit').serialize()
        ).then(function(response) {
            
            $('#modifyemailModel').modal('hide');
            if(isEdditMode){
              swal("Updated!", "Template updated successfully!", "success");
            }else{
              swal("Created!", "Template created successfully!", "success");
            }
            
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
  $(document).ready(function() {
      $('#summernote').summernote({
        height: 300, // set editor height
        toolbar: [
          // [groupName, [list of button]]
          ['style', ['bold', 'italic', 'underline', 'clear']],
          ['font', ['strikethrough', 'superscript', 'subscript']],
          ['fontsize', ['fontsize']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview']],
          ['help', ['help']]
        ]
      });
    });
    $(document).on('click', '.editTempModal', function() {
        isEdditMode=true;
        
        $('#title').val($(this).data('title'));
        // $('#content').val($(this).data('content'));
        $('#summernote').summernote('code',$(this).data('content'));
        $('#id').val($(this).data('id'));
        $('#modifyemailModel').modal('show');
    });
    $(document).on('click', '.deleteTemp', function() {
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
          axios.post("{{route('delete-template')}}",
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