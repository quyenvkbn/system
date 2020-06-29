@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Vai trò</h1>
@stop

@section('content')
   	<div class="card">
   		<div class="card-header">
            <h3 class="card-title"><a href="{{ route('role.create') }}" class="btn-sm btn-success"><i class="fas fa-plus-square"></i>&nbsp; Thêm mới</a></h3>

            <div class="card-tools">
              <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                <div class="input-group-append">
                  <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                </div>
              </div>
            </div>
        </div>
        <div class="card-body table-responsive p-0">
        	<table class='table table-head-fixed text-nowrap'>
        		<thead>
        			<tr>
                	<th>ID</th>
                	<th>Name</th>
                	<th style="width: 160px;">Action</th>
              </tr>
        		</thead>
        		<tbody>
        			@if($roles)
	        			@foreach($roles as $key => $item)
    							<tr>
                  	<td>{{ $item->id }}</td>
                  	<td>{{ $item->name }}</td>
                  	<td>
                  		<form class="row" method="POST" action="{{ route('role.destroy', ['role' => $item->id]) }}" onsubmit = "return confirm('Chắc chắn xoá?')">
                  			@csrf
    										@method('DELETE')
    										<div class="btn-group" role="group" aria-label="Basic example">
    										  	<a href="{{ route('role.show', ['role' => $item->id]) }}" type="button" class="btn btn-secondary" title="Xem"><i class="fas fa-fw fa-eye "></i></a>
    										  	<a href="{{ route('role.edit', ['role' => $item->id]) }}" type="button" class="btn btn-secondary" title="Sửa"><i class="fas fa-fw fa-edit "></i></a>
    										  	<button type="submit" class="btn btn-secondary" title="Xóa"><i class="fas fa-fw fa-trash "></i></button>
    										</div>
    									</form>
                  	</td>
                  </tr>
	        			@endforeach
	        		@else
	        			<tr><td colspan="3">Dữ liệu đang cập nhật</td></tr>
        			@endif
        		</tbody>
        	</table>
        </div>
   	</div>
@stop