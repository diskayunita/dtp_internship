@extends('layouts.admin.telkom')

@section('content')
	<div class="col-md-8 col-md-offset-2">

		<div class="card">
			<form method="post" action="{{route('admin.permission.store')}}" enctype="multipart/form-data" class="form-horizontal">
				{{ csrf_field() }}

				<div class="card-header">
					<h4 class="card-title">
						<i class="ti-plus"></i> Create Permission
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
		</div>  <!-- end card -->

	</div>
@endsection