<h4>@lang('event/event-create.person') (P.I.C)</h4>
<hr>

<div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
    <label for="username" class="col-md-4 control-label">
        @lang('event/event-create.name')
    </label>
    <div class="col-md-8">
        <input id="username" type="text" class="form-control" name="username" value="{{ valPIC(old('username') , $event->username, \Auth::user()->name) }}" required autofocus readonly="">
        @include('layouts.error_helpbox', ['data' => 'username'])
    </div>
</div>

<div class="form-group{{ $errors->has('contact') ? ' has-error' : '' }}">
    <label for="contact" class="col-md-4 control-label">
        @lang('event/event-create.contact')
    </label>
    <div class="col-md-8">
        <input id="contact" type="text" size="13" maxlength="13" type="text" onkeypress="numberOnly(event)" class="form-control" name="contact" value="{{ valPIC( old('contact') , $event->contact, \Auth::user()->mobile_number) }}" required autofocus readonly="">
        @include('layouts.error_helpbox', ['data' => 'contact'])
    </div>
</div>

<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
    <label for="email" class="col-md-4 control-label">
        @lang('event/event-create.email')
    </label>
    <div class="col-md-8">
        <input id="email" type="text" class="form-control" name="email" value="{{valPIC( old('email'), $event->email, \Auth::user()->email)}}" required autofocus readonly="">
        @include('layouts.error_helpbox', ['data' => 'email'])
    </div>
</div>

<div class="form-group{{ $errors->has('university') ? ' has-error' : '' }}">
    <label for="university" class="col-md-4 control-label">
        @lang('event/event-create.university')
    </label>
    <div class="col-md-8">
        <input id="university" type="text" class="form-control" name="university" value="{{valPIC( old('university'), $event->university, \Auth::user()->university)}}" required autofocus readonly="">
        @include('layouts.error_helpbox', ['data' => 'university'])
    </div>
</div>

<div class="form-group{{ $errors->has('faculty') ? ' has-error' : '' }}">
    <label for="faculty" class="col-md-4 control-label">
        @lang('event/event-create.faculty')    </label>
    <div class="col-md-8">
        <input id="faculty" type="text" class="form-control" name="faculty" value="{{valPIC( old('faculty'), $event->faculty, \Auth::user()->faculty)}}" required autofocus readonly="">
        @include('layouts.error_helpbox', ['data' => 'faculty'])
    </div>
</div>
