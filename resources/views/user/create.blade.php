@extends('quyenvkbn::layout.layout')

@section('title', 'Dashboard')

@section('content_header')
    <h1>@lang('quyenvkbn::system.create_member')</h1>
@stop

@section('content')
   	<div class="card">
   		<form class="form-horizontal"  action="{{ route('user.store') }}" enctype="multipart/form-data" method="post">
   			@csrf
			<div class="card-body">
				<div class="form-group row">
					<div class="col-md-2">
			        	<label for="">@lang('quyenvkbn::system.name')</label>
			        </div>
			        <div class="col-md-10">
			        	<input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="@lang('quyenvkbn::system.name')" class="form-control @error('name') is-invalid @enderror">
			        	@error('name')
						    <div class="alert alert-danger">{{ $message }}</div>
						@enderror
			        </div>
		        </div>
				<div class="form-group row">
					<div class="col-md-2">
			        	<label for="">@lang('quyenvkbn::system.email')</label>
			        </div>
			        <div class="col-md-10">
			        	<input id="email" type="text" name="email" value="{{ old('email') }}" placeholder="@lang('quyenvkbn::system.email')" class="form-control @error('email') is-invalid @enderror">
			        	@error('email')
						    <div class="alert alert-danger">{{ $message }}</div>
						@enderror
			        </div>
		        </div>
				<div class="form-group row">
					<div class="col-md-2">
			        	<label for="">@lang('quyenvkbn::system.password')</label>
			        </div>
			        <div class="col-md-10">
			        	<input id="password" type="password" name="password" value="{{ old('password') }}" placeholder="@lang('quyenvkbn::system.password')" class="form-control @error('password') is-invalid @enderror">
			        	@error('password')
						    <div class="alert alert-danger">{{ $message }}</div>
						@enderror
			        </div>
		        </div>
				<div class="form-group row">
					<div class="col-md-2">
			        	<label for="">@lang('quyenvkbn::system.role')</label>
			        </div>
			        <div class="col-md-10">
			        	@if($roles)
				        	@php
				        		$post_permission = (array)old('rolesUser');
				        	@endphp
							<div class="row">
								@foreach($roles as $key => $value)
									<div class="col-md-4">
										<div class="custom-control custom-checkbox">
				                          	<input class="custom-control-input" 
				                          		name="rolesUser[{{ $value->id }}]" value="{{ $value->id }}" type="checkbox" id="customCheckbox{{ $value->id }}" {{ in_array($value->id, $post_permission) ? 'checked=""' : '' }}>
				                          	<label for="customCheckbox{{ $value->id }}" class="custom-control-label">
				                          		{{ $value->name }}
				                          	</label>
				                        </div>
									</div>
									
								@endforeach
							</div>
							@error('rolesUser')
							    <div class="alert alert-danger">{{ $message }}</div>
							@enderror
			        	@endif
				        	
			        </div>
		        </div>
			</div>
			<div class="card-footer">
              <button type="submit" class="btn btn-primary">@lang('quyenvkbn::system.submit')</button>
            </div>
		</form>
   	</div>
@stop