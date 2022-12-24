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
                        Edit User Profile
                    </div>
                    <div class="card-body">
                    	<div class="form-group row">
	                    	<div class="col-md-12" style="text-align:center;">
	                    		
	                    		<img width="120" style="border-radius: 50%;" src="{{ asset('storage/'.$user->avatar_path) }}" alt="profile Image">
	                    	</div>
                    	</div>
                    	
                        <form  method="POST" action="{{route('profile.update')}}" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="form-group row">
                                <label for="avatar" class="col-md-4 col-form-label text-md-right">Avatar</label>

                                <div class="col-md-6">
                                    <input type="file" id="avatar" name="avatar" class="form-control @error('avatar') is-invalid @enderror">

                                    @error('avatar')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                                <div class="col-md-6">
                                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="form-control @error('name') is-invalid @enderror">

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                                <div class="col-md-6">
                                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="form-control @error('email') is-invalid @enderror">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                <div class="col-md-6">
                                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror">

                                    @error('password')
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
