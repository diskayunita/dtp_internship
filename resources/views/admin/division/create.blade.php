@extends('layouts.admin.telkom')

@section('content')
	<div class="col-md-8 col-md-offset-2">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">
					<i class="ti-plus"></i> Create division
				</h4>
				<p class="division">Create new article division</p>
			</div>

			<form method="post" action="{{route('admin.division.store')}}" enctype="multipart/form-data" class="form-horizontal">
				{{-- card-content --}}
				<div class="card-content">
					{{ csrf_field() }}

					{{-- tab-navigation --}}
                    @include('admin.division.partials.nav_tabs')

					<div class="tab-content">
                        @include('admin.division.partials.form_fields')
					</div>
				</div>
				{{-- card-content --}}

				<div class="card-footer">
					<div class="form-group text-center">
						<a href="{!! route('admin.division.index') !!}" class="btn btn-md btn-default btn-fill btn-wd btn-move-left">
							<span class="btn-label">
								<i class="ti-angle-left"></i>
							</span>
							Cancel
						</a>
						<button type="submit" class="btn btn-primary btn-fill btn-wd">
							<i class="ti-check"></i>
							Submit
						</button>
					</div>
				</div>
			</form>
		</div>  <!-- end card -->
	</div>
@endsection