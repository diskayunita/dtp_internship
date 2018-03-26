@if ($errors->has($data))
    <span class="help-block">
        <strong>{{ $errors->first($data) }}</strong>
    </span>
@endif