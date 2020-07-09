@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>@lang('quyenvkbn::system.detail_role')</h1>
@stop

@section('content')
  <div class="card card-success">
    <div class="card-header">
      <h3 class="card-title">{{ $role->name }}</h3>
    </div>
    <div class="card-body">
      @if($permission)
        <div class="row">
          @foreach($permission as $key => $value)
            <div class="col-md-4">
              <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" 
                    name="permission[{{ $value->id }}]" value="{{ $value->id }}" type="checkbox" id="customCheckbox{{ $value->id }}" {{ in_array($value->id, $role->permission) ? 'checked=""' : '' }} disabled>
                  <label for="customCheckbox{{ $value->id }}" class="custom-control-label">
                    {{ $value->name }}
                  </label>
              </div>
            </div>
            
          @endforeach
        </div>
      @endif
    </div>
    <!-- /.card-body -->
  </div>
@stop