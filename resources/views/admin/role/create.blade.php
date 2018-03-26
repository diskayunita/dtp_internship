@extends('layouts.admin.telkom')

@section('content')
	<div class="col-md-12">
		<form method="post" action="{{route('admin.role.store')}}" enctype="multipart/form-data" class="form-horizontal">
			{{ csrf_field() }}

			<div class="card">
				<div class="card-header">
					<h4 class="card-title">
						<i class="ti-plus"></i> Create Role
					</h4>
				</div>{{-- card-header --}}

				<div class="card-content">
					@include('admin.role.fields')
				</div>{{-- card-content --}}

				<div class="card-footer text-center">
					<a href="{!! route('admin.role.index') !!}" class="btn btn-default btn-fill btn-wd btn-move-left">
						<i class="ti-angle-left"></i> Cancel
					</a>
					<button type="submit" class="btn btn-primary btn-fill btn-wd">
						<i class="ti-check"></i> Submit
					</button>
				</div>

			</div>{{-- card --}}

		</form>
	</div>
@endsection