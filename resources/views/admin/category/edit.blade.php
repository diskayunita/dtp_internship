@extends('layouts.admin.telkom')

@section('content')
	<div class="col-md-8 col-md-offset-2">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">
					<i class="ti-pencil"></i> Edit Category
				</h4>
				<p class="category">Edit and update existing article category</p>
			</div>

			<form id="form-update" class="form-horizontal" style="margin-top: 10px;" method="post" action="{{route('admin.update_category', $category->id)}}" enctype="multipart/form-data">
				{{-- card-content --}}
				<div class="card-content">
					{{ csrf_field() }}

					{{-- tab-navigation --}}
                    @include('admin.category.partials.nav_tabs')

					<div class="tab-content">
                        @include('admin.category.partials.form_fields')
					</div>
				</div>
				{{-- card-content --}}

				<div class="card-footer">
					<div class="form-group text-center">
						<a href="{!! route('admin.category.index') !!}" class="btn btn-md btn-default btn-fill btn-wd btn-move-left">
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