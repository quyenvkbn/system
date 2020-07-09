@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>@lang('quyenvkbn::system.update_member')</h1>
@stop

@section('content')
   	<div class="card">
   		<form class="form-horizontal"  action="{{ route('user.update', ['user' => $user->id]) }}" enctype="multipart/form-data" method="post">
   			@csrf
			@method('PATCH')
			<div class="card-body">
				<div class="form-group row">
					<div class="col-md-2">
			        	<label for="">@lang('quyenvkbn::system.name')</label>
			        </div>
			        <div class="col-md-10">
			        	<input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control @error('name') is-invalid @enderror">
			        	<input id="id" type="hidden" name="id" value="{{ $user->id }}">
			        	@error('name')
						    <div class="alert alert-danger">{{ $message }}</div>
						@enderror
			        </div>
		        </div>
				<div class="form-group row">
					<div class="col-md-2">
			        	<label for="">Email</label>
			        </div>
			        <div class="col-md-10">
			        	<input id="email" readonly="" type="text" value="{{ $user->email }}" class="form-control">
			        </div>
		        </div>
				<div class="form-group row">
					<div class="col-md-2">
			        	<label for="">@lang('quyenvkbn::system.role')</label>
			        </div>
			        <div class="col-md-10">
			        	@if($roles)
				        	@php
				        		$post_roles = (array)old('rolesUser', $user->rolesUser);
				        	@endphp
							<div class="row">
								@foreach($roles as $key => $value)
									<div class="col-md-4">
										<div class="custom-control custom-checkbox">
				                          	<input class="custom-control-input" 
				                          		name="rolesUser[{{ $value->id }}]" value="{{ $value->id }}" type="checkbox" id="customCheckbox{{ $value->id }}" {{ in_array($value->id, $user->rolesUser) ? 'checked=""' : '' }}>
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