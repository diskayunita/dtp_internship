@extends('layouts.admin.telkom')

@section('content')

	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">
					<i class="fa fa-info-circle"></i>
					Message Details
				</h4>
			</div>

			<div class="card-content">
				<form method="post" class="form-horizontal">
					{{ csrf_field() }}
					@include('admin.contact.fields')
				</form>
			</div>

			<div class="card-footer">
			</div>
		</div>

		<div class="card">
			<div class="card-header">
				<h4 class="card-title">`
					<i class="fa fa-paper-plane"></i>
					Reply Contact
				</h4>
			</div>

			<form id="form-update" class="form-horizontal" style="margin-top: 10px;" method="post" action="{{route('admin.reply_message', $message->id)}}" enctype="multipart/form-data">
				<div class="card-content">
					{{ csrf_field() }}
					<fieldset>
						<div class="form-group">
							<label class="col-sm-2 control-label">Message</label>
							<div class="col-sm-10">
								<input type="hidden" name="recipient_id" value="{{ $message->id }}">
								<input type="hidden" name="recipient_name" value="{{ $message->user_id }}">
								<input type="hidden" name="recipient_name" value="{{ $message->username }}">
								<input type="hidden" name="recipient_email" value="{{ $message->email }}">
								<input type="hidden" name="recipient_subject" value="{{ $message->subject }}">
								<input type="hidden" name="recipient_message" value="{{ $message->message }}">
								<textarea  placeholder="Message" name="reply_message" value="" class="form-control border-input" rows="6"></textarea>
							</div>
						</div>
					</fieldset>
				</div>
				<div class="card-footer">
					<div class="form-group text-center">
						<a href="{!! route('admin.contact.index') !!}" class="btn btn-md btn-default btn-fill btn-wd btn-move-left">
							<span class="btn-label">
								<i class="ti-angle-left"></i>
							</span>
							Back
						</a>
						<button type="submit" class="btn btn-primary btn-fill btn-wd">
							<i class="ti-check"></i>
							Send
						</button>
					</div>
				</div>
			</form>
		</div>  <!-- end card -->

		<div class="card">
			<div class="card-header">
				<h4 class="card-title">
                    <i class="fa fa-table"></i>
					Reply Table
				</h4>
				<p class="category"></p>
			</div>
			<div class="card-content table-responsive">
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>#</th>
							<th>Message</th>
						</tr>
					</thead>
					<tbody>
					@foreach($message->reply as $no=>$reply)
						<tr>
							<td>{{$no+1}}</td>
							<td>{{$reply->message ? $reply->message : '-'}}</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection