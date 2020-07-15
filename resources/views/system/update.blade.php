@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>@lang('quyenvkbn::system.system')</h1>
@stop

@section('content')
   	<div class="card">
   		<form class="form-horizontal"  action="{{ route('system.update', ['system' => 1]) }}" enctype="multipart/form-data" method="post">
   			@csrf
			@method('PATCH')
	   		@if($system)
		    	@php $i = 0; @endphp
		    	<nav>
		  			<div class="nav nav-tabs" id="nav-tab" role="tablist">
						@foreach($system as $key => $value)
							<a class="nav-item nav-link {{ $i == 0 ? 'active' : '' }}" id="nav-{{ $key }}-tab" data-toggle="tab" href="#nav-{{ $key }}" role="tab" aria-controls="nav-{{ $key }}" aria-selected="true">{{ $key }}</a>
							@php $i++; @endphp
						@endforeach
					</div>
				</nav>

				@php $i = 0; @endphp
				<div class="tab-content" id="nav-tabContent">
					@foreach($system as $key => $value)
						<div class="tab-pane card-body fade show {{ $i == 0 ? 'active' : '' }}" id="nav-{{ $key }}" role="tabpanel" aria-labelledby="nav-{{ $key }}-tab">
							@if($value)
								@foreach($value as $k => $val)
									<div class="form-group row">
										<div class="col-md-2">
												<label for="">
													{{ Lang::has('quyenvkbn::system.'.$val['label_or_lang']) ? __('quyenvkbn::system.'.$val['label_or_lang']) : $val['label_or_lang'] }}
												</label>
								        	
								        </div>
										@switch($val['type'])
										    @case('dropdown')
											    <div class="col-md-10">
											        <select name="{{ $k }}" id="" class="form-control">
											        	@if(!empty($val['first_select']))
															<option value="0">
																{{ $val['first_select'] }}
															</option>
											        	@endif
														@foreach($val['data'] as $ks => $vals)
															<option data-value="{{$val['value']}}" value="{{ $vals->id }}" {{ $vals->id == $val['value'] ? 'selected' : '' }}>
																{{ $vals->title }}
															</option>
														@endforeach
											        </select>
											    </div>
										        @break

										    @case('textarea')
										        <div class="col-md-10">
										        	<textarea type="text" class="form-control" name="{{ $k }}" value="{{ $val['value'] }}">{{ $val['value'] }}</textarea>
										        </div>
										        @break

										    @case('image')
										        <div class="col-md-10">
										        	<input onclick="openPopup(1, '{{ $k }}')" type="text" class="form-control" id="{{ $k }}" name="{{ $k }}" value="{{ $val['value'] }}">
										        </div>
										        @break

										    @case('editor')
										        <div class="col-md-10">
										        	<textarea type="text" class="form-control ckeditor-description" id="{{ $k }}" name="{{ $k }}" value="{{ $val['value'] }}">{{ $val['value'] }}</textarea>
										        </div>
										        @break

										    @default
										        <div class="col-md-10">
										        	<input type="text" class="form-control" name="{{ $k }}" value="{{ $val['value'] }}">
										        </div>
										@endswitch
									</div>
								@endforeach
							@endif
						</div>
						@php $i++; @endphp
					@endforeach
				</div>
				<div class="card-footer">
                  <button type="submit" class="btn btn-primary">@lang('quyenvkbn::system.submit')</button>
                </div>
		    @endif
		</form>
   	</div>
@stop