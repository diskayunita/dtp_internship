<!-- Nama Category -->
<div class="form-group">
    <label class="col-sm-2 control-label">Name</label>
    <div class="col-sm-10">
        <input placeholder="Name" name="name" value="{!! $contact->exists ? $contact->name : '' !!}" class="form-control border-input" type="text" {!! $contact->exists ? 'readonly' : 'required' !!}>
    </div>
</div>
<!-- /Nama Category -->

<!-- Description Category -->
<div class="form-group">
    <label class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
        <input placeholder="Email" name="email" value="{!! $contact->exists ? $contact->email : '' !!}" class="form-control border-input" type="text" {!! $contact->exists ? 'readonly' : 'required' !!}>
    </div>
</div>
<!-- /Description Category -->

<!-- Description Category -->
<div class="form-group">
    <label class="col-sm-2 control-label">Subject</label>
    <div class="col-sm-10">
        <input placeholder="Subject" name="subject" value="{!! $contact->exists ? $contact->subject : '' !!}" class="form-control border-input" type="text" {!! $contact->exists ? 'readonly' : 'required' !!}>
    </div>
</div>
<!-- /Description Category -->

<!-- Description Category -->
<div class="form-group">
    <label class="col-sm-2 control-label">Message</label>
    <div class="col-sm-10">
        <textarea  placeholder="Message" name="message" value="" class="form-control border-input" {!! $contact->exists ? 'readonly' : 'required' !!}>{!! $contact->exists ? $contact->message : '' !!}</textarea>
    </div>
</div>
<!-- /Description Category -->