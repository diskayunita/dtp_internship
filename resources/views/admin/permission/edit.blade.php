@extends('layouts.admin.telkom')

@section('content')
	<div class="col-md-8 col-md-offset-2">

		<div class="card">
			<form id="form-update" class="form-horizontal" style="margin-top: 10px;" method="post" action="{{route('admin.update_permission', $permission->id)}}" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="card-header">
					<h4 class="card-title">
						<i class="ti-pencil"></i> Edit Permission
					</h4>
				</div>

				<div class="card-content">
					@include('admin.permission.fields')
				</div>

				<div class="card-footer text-center">
					<a href="{!! route('admin.permission.index') !!}" class="btn btn-default btn-fill btn-wd btn-move-left">
						<i class="ti-angle-left"></i> Cancel
					</a>
					<button type="submit" class="btn btn-primary btn-fill btn-wd">
						<i class="ti-check"></i> Submit
					</button>
				</div>
			</form>
		</div>{{-- card --}}

	</div>
@endsection