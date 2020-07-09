@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>@lang('quyenvkbn::system.update_role')</h1>
@stop

@section('content')
   	<div class="card">
   		<form class="form-horizontal"  action="{{ route('role.update', ['role' => $role->id]) }}" enctype="multipart/form-data" method="post">
   			@csrf
			@method('PATCH')
			<div class="card-body">
				<div class="form-group row">
					<div class="col-md-2">
			        	<label for="">@lang('quyenvkbn::system.name')</label>
			        </div>
			        <div class="col-md-10">
			        	<input id="name" type="text" name="name" value="{{ old('name', $role->name) }}" class="form-control @error('name') is-invalid @enderror">
			        	<input id="id" type="hidden" name="id" value="{{ $role->id }}">
			        	@error('name')
						    <div class="alert alert-danger">{{ $message }}</div>
						@enderror
			        </div>
		        </div>
				<div class="form-group row">
					<div class="col-md-2">
			        	<label for="">@lang('quyenvkbn::system.role')</label>
			        </div>
			        <div class="col-md-10">
			        	@if($permission)
				        	@php
				        		$post_permission = (array)old('permission', $role->permission);
				        	@endphp
							<div class="row">
								@foreach($permission as $key => $value)
									<div class="col-md-4">
										<div class="custom-control custom-checkbox">
				                          	<input class="custom-control-input" 
				                          		name="permission[{{ $value->id }}]" value="{{ $value->id }}" type="checkbox" id="customCheckbox{{ $value->id }}" {{ in_array($value->id, $post_permission) ? 'checked=""' : '' }}>
				                          	<label for="customCheckbox{{ $value->id }}" class="custom-control-label">
				                          		{{ $value->name }}
				                          	</label>
				                        </div>
									</div>
									
								@endforeach
							</div>
							@error('permission')
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