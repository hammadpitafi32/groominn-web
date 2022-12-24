@extends('layouts.admin')

@section('content')
<div class="card shadow mb-4">
	@if (session('success'))
	    <div class="alert alert-success">
	        {{ session('success') }}
	    </div>
	@endif
	<div class="card-body">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Edit Settings
                    </div>
                    <div class="card-body">
                    	<div class="form-group row">
	                    	<div class="col-md-12" style="text-align:center;">
	                    		
	                    		<img width="120" style="border-radius: 50%;" src="{{ asset('storage/'.$logo) }}" alt="logo">
	                    	</div>
                    	</div>
                    	
                        <form  method="POST" action="{{route('settings.update')}}" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="form-group row">
                                <label for="avatar" class="col-md-4 col-form-label text-md-right">Site Logo</label>

                                <div class="col-md-6">
                                    <input type="file" id="avatar" name="site_logo" class="form-control @error('avatar') is-invalid @enderror">

                                    @error('avatar')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="radius" class="col-md-4 col-form-label text-md-right">Search Radius</label>

                                <div class="col-md-6">
                                    <input type="number" id="radius" name="radius" value="{{ old('name', $radius) }}" class="form-control @error('name') is-invalid @enderror">

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

 
                            <div class="form-group row">
                              

                                <div class="col-md-12" style="text-align:center;">
                                   <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                         </form>
                     </div>
                 </div>
             </div>
         </div>
     </div>

</div>
@endsection
