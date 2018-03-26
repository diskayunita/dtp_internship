@extends('layouts.admin.telkom')

@section('content')
	<div class="col-md-8 col-md-offset-2">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">
					<i class="ti-pencil"></i> Edit Event Purpose
				</h4>
				<p class="purpose">Edit and update existing event purpose</p>
			</div>

			<form id="form-update" class="form-horizontal" style="margin-top: 10px;" method="post" action="{{ route('admin.update_purpose', $purpose->id) }}" enctype="multipart/form-data">
				<div class="card-content">
					{{ csrf_field() }}{{ method_field('patch') }}

					{{-- tab-navigation --}}
					@include('admin.purpose.partials.nav_tabs')

					<div class="tab-content">
						@include('admin.purpose.partials.form_fields')
					</div>
				</div>

				<div class="card-footer">
					<div class="form-group text-center">
						<a href="{!! route('admin.purpose.index') !!}" class="btn btn-md btn-default btn-fill btn-wd btn-move-left">
							<i class="ti-angle-left"></i> Cancel
						</a>
						<button type="submit" class="btn btn-primary btn-fill btn-wd">
							<i class="ti-check"></i> Submit
						</button>
					</div>
				</div>
			</form>
		</div>  <!-- end card -->
	</div>
@endsection