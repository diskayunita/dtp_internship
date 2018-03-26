@extends('layouts.admin.telkom')

@section('content')
	<div class="col-md-8 col-md-offset-2">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">
					<i class="ti-plus"></i> Create Event Destination
				</h4>
				<p class="category">Create new event destination</p>
			</div>{{-- card-header --}}

			<form method="post" action="{{route('admin.purpose.store')}}" enctype="multipart/form-data" class="form-horizontal">
				<div class="card-content">
					{{ csrf_field() }}

					{{-- tab-navigation --}}
                    @include('admin.purpose.partials.nav_tabs')

					<div class="tab-content">
                        @include('admin.purpose.partials.form_fields')
					</div>
				</div>{{-- card-content --}}

				<div class="card-footer">
					<div class="form-group text-center">
						<a href="{!! route('admin.purpose.index') !!}" class="btn btn-md btn-default btn-fill btn-wd btn-move-left">
							<i class="ti-angle-left"></i>
							Cancel
						</a>
						<button type="submit" class="btn btn-primary btn-fill btn-wd">
							<i class="ti-check"></i>
							Submit
						</button>
					</div>
				</div>
			</form>
		</div>  {{-- card End --}}
	</div>
@endsection