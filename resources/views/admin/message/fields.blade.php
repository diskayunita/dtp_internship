<!-- Nama Category -->
<div class="form-group">
    <label class="col-sm-2 control-label">Name</label>
    <div class="col-sm-10">
        <input placeholder="Name" name="name" value="{!! $message->exists ? $message->name : '' !!}" class="form-control border-input" type="text" {!! $message->exists ? 'readonly' : 'required' !!}>
    </div>
</div>
<!-- /Nama Category -->

<!-- Description Category -->
<div class="form-group">
    <label class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
        <input placeholder="Email" name="email" value="{!! $message->exists ? $message->email : '' !!}" class="form-control border-input" type="text" {!! $message->exists ? 'readonly' : 'required' !!}>
    </div>
</div>
<!-- /Description Category -->

<!-- Description Category -->
<div class="form-group">
    <label class="col-sm-2 control-label">Subject</label>
    <div class="col-sm-10">
        <input placeholder="Subject" name="subject" value="{!! $message->exists ? $message->subject : '' !!}" class="form-control border-input" type="text" {!! $message->exists ? 'readonly' : 'required' !!}>
    </div>
</div>
<!-- /Description Category -->

<!-- Description Category -->
<div class="form-group">
    <label class="col-sm-2 control-label">Message</label>
    <div class="col-sm-10">
        <textarea  placeholder="Message" name="message" value="" class="form-control border-input" {!! $message->exists ? 'readonly' : 'required' !!}>{!! $message->exists ? $message->message : '' !!}</textarea>
    </div>
</div>
<!-- /Description Category -->