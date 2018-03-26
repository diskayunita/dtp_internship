@extends('layouts.admin.telkom')

@section('content')
	<div class="col-md-8 col-md-offset-2">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">
					<i class="ti-plus"></i> Create Agency
				</h4>
				<p class="category">Create new Agency</p>
			</div>

			<form method="post" action="{{route('admin.agency.store')}}" enctype="multipart/form-data" class="form-horizontal">
				<div class="card-content">
					{{ csrf_field() }}
					{{-- tab-navigation --}}
                    @include('admin.agency.partials.nav_tabs')

					<div class="tab-content">
                        @include('admin.agency.partials.form_fields')
					</div>
				</div>

				<div class="card-footer">
					<div class="form-group text-center">
						<a href="{!! route('admin.agency.index') !!}" class="btn btn-md btn-default btn-fill btn-wd btn-move-left">
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