@extends('quyenvkbn::layout.layout')

@section('title', 'Dashboard')

@section('content_header')
    <h1>@lang('quyenvkbn::system.detail_member')</h1>
@stop

@section('content')
  <div class="card card-success">
    <div class="card-header">
      <h3 class="card-title">{{ $user->name }}</h3>
    </div>
    <div class="card-body">
      @if($roles)
        <div class="row">
          @foreach($roles as $key => $value)
            <div class="col-md-4">
              <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" 
                    name="rolesUser[{{ $value->id }}]" value="{{ $value->id }}" type="checkbox" id="customCheckbox{{ $value->id }}" {{ in_array($value->id, $user->rolesUser) ? 'checked=""' : '' }} disabled>
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