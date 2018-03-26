@extends('layouts.admin.telkom')

@section('content')

	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Create Contact</h4>
                <p class="category"></p>
			</div>
			<form method="post" action="{{route('admin.message.store')}}" enctype="multipart/form-data" class="form-horizontal">
				<div class="card-content">
                    {{ csrf_field() }}
                    @include('admin.message.fields')
                </div>
                <div class="card-footer">
                    <div class="form-group text-center">
                        <a href="{!! route('admin.message.index') !!}" class="btn btn-md btn-default btn-fill btn-wd btn-move-left">
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