@extends('layouts.admin.telkom')

@section('style')
    <style type="text/css">
        .datepicker-orient-top{
            z-index: 99999 !important;
        }
        .ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default {
            border-radius: 0 !important;
            box-shadow: none !important;
            height: auto;
            width: auto;
            cursor: pointer;
        }
        ..ui-widget-content a {
            color: #333333 !important;
        }
        .ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default, .ui-button, html .ui-button.ui-state-disabled:hover, html .ui-button.ui-state-disabled:active {
            border: 1px solid #c5c5c5 !important;
            background: #f6f6f6 !important;
            font-weight: normal !important;
            color: #454545 !important;
        }
        .ui-widget-content {
            border: 1px solid #dddddd !important;
            background: #ffffff !important;
            color: #333333 !important;
        }
        .ui-widget {
            font-family: Arial,Helvetica,sans-serif  !important;
            font-size: 1em  !important;
        }
    </style>
@endsection

@section('content')
	<div class="col-md-8 col-md-offset-2">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">
					<i class="ti-pencil"></i> Edit Blocked Date
				</h4>
				<p class="category">Edit and update existing blocked date</p>
			</div>

			<form id="form-update" class="form-horizontal" style="margin-top: 10px;" method="post" action="{{route('admin.update_blockeddate', $blocked->id)}}" enctype="multipart/form-data">
				{{-- card-content --}}
				<div class="card-content">
					{{ csrf_field() }}
                    @include('admin.bloceddate.partials.form_fields')
				</div>
				{{-- card-content --}}

				<div class="card-footer">
					<div class="form-group text-center">
						<a href="{!! route('admin.blokeddate.index') !!}" class="btn btn-md btn-default btn-fill btn-wd btn-move-left">
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

@section('script')
	<script type="text/javascript">
        var tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + {!! isset($mindate) ? $mindate : 1 !!});
        var disableddates=[{!!empty($disableddate) ? '' : $disableddate !!}];
         $('#datepicker').datepicker({
            minDate: tomorrow,
            setDate: tomorrow,
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true,
            beforeShowDay: function(date){
        		var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
                var day = date.getDay();
                return [ disableddates.indexOf(string) == -1 && day != 0 && day != 6 ]
            },
         });
    </script>
@endsection