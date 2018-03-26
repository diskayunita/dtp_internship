@extends('layouts.admin.telkom')

@section('content')
	<div class="col-md-12">
		<div class="card">
			<form method="post" action="{{route('admin.category.store')}}" enctype="multipart/form-data" class="form-horizontal">
				{{ csrf_field() }}

				<div class="card-header">
					<h4 class="card-title">Create Category</h4>
				</div>{{-- card-header --}}

				<div class="card-content">
					@include('admin.event.fields')
				</div>{{-- card-content --}}

				<div class="card-footer text-center">
					<a href="{!! route('admin.event.index') !!}" class="btn btn-default btn-fill btn-wd btn-move-left">
						<span class="btn-label">
							<i class="ti-angle-left"></i>
						</span>
						Cancel
					</a>
					<button type="submit" class="btn btn-primary btn-fill btn-wd">
						<i class="ti-check"></i>
						Submit
					</button>
				</div>{{-- card-footer --}}
			</form>
		</div>{{-- card --}}
	</div>
@endsection
