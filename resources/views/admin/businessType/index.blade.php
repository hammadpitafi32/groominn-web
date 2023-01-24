@extends('layouts.admin')

@section('content')
<!-- Page Heading -->
<!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
<div class="card-header py-3 d-inline">
  <h6 class="m-0 font-weight-bold text-primary">Business Type</h6>
  <a href="#" class="btn btn-primary btn-icon-split float-right" data-toggle="modal" data-target="#modifyTypeModel">
    <span class="icon text-white-50">
      <i class="fas fa-plus"></i>
    </span>
    <span class="text">Add Business Type</span>
  </a>
</div>
<div class="card-body">
  <div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <thead>
        <tr>
          <th>Action</th>
          <th>Image</th>
          <th>Name</th>
          <th>Created At</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th>Action</th>
          <th>Image</th>
          <th>Name</th>
          <th>Created At</th>
        </tr>
      </tfoot>
      <tbody>
        @foreach($types as $type)
        <tr>
          <td>
            <a href="javascript:void(0);" class="btn btn-success btn-circle btn-sm editTypeModal" data-id="{{$type->id}}" data-name="{{$type->name}}" data-image="{{$type->image}}">
                <i class="fas fa-edit"></i>
            </a>
            | <a href="javascript:void(0);" class="btn btn-danger btn-circle btn-sm deleteType" data-id="{{$type->id}}">
                <i class="fas fa-trash"></i>
            </a>
            
          </td>
          <td><img src="{{$type->image}}"></td>
          <td>{{$type->name}}</td>
          <td>{{$type->created_at}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
</div>

{{-- models here --}}
<div class="modal fade" id="modifyTypeModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Business Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="typeSubmit" action="{{route('create-business-type')}}">
                <input type="hidden" id="id" name="id">
                {{csrf_field()}}
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="first_name">Name</label>
                            <input type="text" class="form-control" placeholder="Enter Name" id="name" name="name" required="">
                        </div>
 
                    </div>

                    <div class="form-row">
                        <div class="form-group col">
                            <label>Select Image</label>
                            <select class="form-control" name="image" id="id_select2_example">
                                <option value="https://groominn.co/images/salon.svg" data-img_src="https://groominn.co/images/salon.svg"></option>
                                <option value="https://groominn.co/images/spa.svg" data-img_src="https://groominn.co/images/spa.svg"></option>
                                <option value="https://groominn.co/assets/img/man.svg" data-img_src="https://groominn.co/assets/img/man.svg"></option>
                                <option value="https://groominn.co/images/yoga.svg" data-img_src="https://groominn.co/images/yoga.svg"></option>
                                <option value="https://groominn.co/images/massage.svg" data-img_src="https://groominn.co/images/massage.svg"></option>
                                <option value="https://groominn.co/images/skincare.svg" data-img_src="https://groominn.co/images/skincare.svg"></option>
                                <option value="https://groominn.co/images/wax.svg" data-img_src="https://groominn.co/images/wax.svg"></option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <p style="color: green;" id="Message"></p>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary modifyType">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('javascripts')

<script type="text/javascript">
    var isEdditMode=false;
    
    $(document).on('click', '.modifyType', function() {
        // alert('s');
        $('.form-control').removeClass('border border-danger');
        $('.form-control').next("span").remove();
        var url="{{route('create-business-type')}}";
        
        if(isEdditMode){
           url="{{route('update-business-type')}}";
        }
        
        axios.post(url,
            $('#typeSubmit').serialize()
        ).then(function(response) {
            
            $('#modifyTypeModel').modal('hide');
            if(isEdditMode){
              swal("Updated!", "Business type updated successfully!", "success");
            }else{
              swal("Created!", "Business type created successfully!", "success");
            }
            
            isEdditMode=false;
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

    $(document).on('click', '.editTypeModal', function() {
        isEdditMode=true;
        // console.log(isEdditMode);
        
        $('#name').val($(this).data('name'));
        $('#image').val($(this).data('image'));
        $('#id').val($(this).data('id'));
        $('#modifyTypeModel').modal('show');
    });
    
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
          axios.post("{{route('delete-business-type')}}",
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
<script type="text/javascript">
    function custom_template(obj){
            var data = $(obj.element).data();
            var text = $(obj.element).text();
            if(data && data['img_src']){
                img_src = data['img_src'];
                template = $("<div><img src=\"" + img_src + "\" style=\"width:60%;\"/><p style=\"font-weight: 700;font-size:14pt;text-align:center;\">" + text + "</p></div>");
                return template;
            }
        }
    var options = {
        'templateSelection': custom_template,
        'templateResult': custom_template,
    }
    $('#id_select2_example').select2(options);
    // $('.select2-container--default .select2-selection--single').css({'height': '220px'});

</script>
@endpush