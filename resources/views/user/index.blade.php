@extends('quyenvkbn::layout.layout')

@section('title', 'Dashboard')

@section('content_header')
    <h1>@lang('quyenvkbn::system.member')</h1>
@stop

@section('content')
   	<div class="card">
   		<div class="card-header">
            <h3 class="card-title"><a href="{{ route('user.create') }}" class="btn-sm btn-success"><i class="fas fa-plus-square"></i>&nbsp; @lang('quyenvkbn::system.create')</a></h3>

            <div class="card-tools">
              <form action="" method="get">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="name" value="{{ request()->name }}" class="form-control float-right" placeholder="@lang('quyenvkbn::system.search')">

                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                  </div>
                </div>
              </form>
            </div>
        </div>
        <div class="card-body table-responsive p-0">
        	<table class='table table-head-fixed text-nowrap'>
        		<thead>
        			<tr>
                	<th>ID</th>
                  <th>@lang('quyenvkbn::system.name')</th>
                	<th>@lang('quyenvkbn::system.email')</th>
                	<th style="width: 160px;">@lang('quyenvkbn::system.action')</th>
              </tr>
        		</thead>
        		<tbody>
        			@if($users)
	        			@foreach($users as $key => $item)
    							<tr>
                    	<td>{{ $item->id }}</td>
                      <td>{{ $item->name }}</td>
                    	<td>{{ $item->email }}</td>
                    	<td>
                    		<form class="row" method="POST" action="{{ route('user.destroy', ['user' => $item->id]) }}" onsubmit = "return confirm('@lang('quyenvkbn::system.definitely_delete')')">
                    			@csrf
    										@method('DELETE')
    										<div class="btn-group" role="group" aria-label="Basic example">
    										  	<a href="{{ route('user.show', ['user' => $item->id]) }}" type="button" class="btn btn-secondary" title="@lang('quyenvkbn::system.read')"><i class="fas fa-fw fa-eye "></i></a>
    										  	<a href="{{ route('user.edit', ['user' => $item->id]) }}" type="button" class="btn btn-secondary" title="@lang('quyenvkbn::system.update')"><i class="fas fa-fw fa-edit "></i></a>
    										  	<button type="submit" class="btn btn-secondary" title="@lang('quyenvkbn::system.delete')"><i class="fas fa-fw fa-trash "></i></button>
    										</div>
    									</form>
                  	</td>
                  </tr>
	        			@endforeach
	        		@else
	        			<tr><td colspan="4">@lang('quyenvkbn::system.the_data_is_updating')</td></tr>
        			@endif
        		</tbody>
        	</table>
        </div>
   	</div>
@stop