<h4>@lang('event/event-create.detail')</h4>
<hr>

{{-- Tipe Event --}}
<div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
    <label for="type" class="col-md-4 control-label">
        <span>
            @lang('event/event-create.purpose')
        </span>
    </label>
    <div class="col-md-8">
        {{-- <select id="type" class="form-control" name="type"> --}}
        <select name="type" id="type" class="form-control" onchange="showfield(this.options[this.selectedIndex].value)">
            <option value="" {{old('type') == '' ? 'selected' : ''}}> -- @lang('event/event-create.choose_purpose') -- </option>
            @foreach($types as $type)
                <option value="{{ $type->name }}" {{ select_s(old('type'), $type, $event->type) }}>
                {{ is_null($type->translation($language)->first()) ? $type->name : $type->translation($language)->first()->name }}
                </option>
            @endforeach
                <option value="Other">@lang('event/event-create.other')</option>
        </select>
        <div id="div1"></div>
        @include('layouts.error_helpbox', ['data' => 'universities'])
    </div>
</div>


{{-- Sisa SKS --}}
<div class="form-group{{ $errors->has('credits') ? ' has-error' : '' }}">
    <label for="credits" class="col-md-4 control-label">
        <span>
            @lang('event/event-create.credits')
        </span>
    </label>
    <div class="col-md-8">
        <input id="credits" type="text" class="form-control" name="credits" value="{{ val(old('credits'), $event->credits) }}" required autofocus>
        @include('layouts.error_helpbox', ['data' => 'credits'])
    </div>
</div>

{{-- Location --}}
{{-- <div class="form-group [ form-group ] {{ $errors->has('title') ? ' has-error' : '' }}">
    <label for="title" class="col-md-4 control-label">
        <span>Event Purpose</span>
    </label>

    <div class="col-md-6">
        <div class="checkbox checkbox-dds checkbox-circle">
            @foreach($purposes as $purpose)
                <input id="{{$purpose->id}}" class="checkbox-event-purpose-dds" name="purpose[{{$purpose->id}}]" type="checkbox">
                <label for="{{$purpose->id}}" class="label-checkbox-event-purpose">
                    {{ $purpose->translation($language)->first() ? $purpose->translation($language)->first()->name : '-' }}
                </label>
                &nbsp;
            @endforeach
        </div>

        @if ($errors->has('title'))
            <span class="help-block">
                <strong>{{ $errors->first('title') }}</strong>
            </span>
        @endif
    </div>
</div> --}}

<div class="form-group [ form-group ] {{ $errors->has('purpose') ? ' has-error' : '' }}" >
    <label for="purpose" class="col-md-4 control-label">
        <span>
            @lang('event/event-create.destination')
        </span>
    </label>

    <div class="col-md-8">
        {{-- <div class="checkbox checkbox-dds checkbox-circle">
            @foreach($purposes as $purpose)
                <input id="purpose[{{$purpose->id}}]" class="checkbox-event-purpose-dds" name="purpose[{{$purpose->id}}]" type="checkbox">
                <label for="purpose[{{$purpose->id}}]" class="label-checkbox-event-purpose">
                    {{ $purpose->translation($language)->first() ? $purpose->translation($language)->first()->name : '-' }}
                </label>
                &nbsp;
            @endforeach
        </div> --}}
        <select class="form-control select2"  id="purpose" multiple="multiple" name="purpose[]" data-placeholder="@lang('event/event-create.location') maximum 2 options">
            @foreach($purposes as $purpose)
                <option value="{{$purpose->id}}" {{ multiselect( old('purpose'), $event->getPurposeIds(), $purpose->id) }}>{{ $purpose->translation($language)->first() ? $purpose->translation($language)->first()->name : '-' }}</option>
            @endforeach
        </select>

        @if ($errors->has('purpose'))
            <span class="help-block">
                <strong>{{ $errors->first('purpose') }}</strong>
            </span>
        @endif
    </div>
</div>

{{--  Event Product --}}
<div class="form-group [ form-group ] {{ $errors->has('product') ? ' has-error' : '' }}">
    <label for="product" class="col-md-4 control-label">
        <span>
            @lang('event/event-create.product')
        </span>
    </label>

    <div class="col-md-8">
        {{-- <div class="checkbox checkbox-dds checkbox-circle">
            @foreach($products as $products)
                <input id="product[{{$products->id}}]" class="checkbox-event-product-dds" name="product[{{$products->id}}]" type="checkbox">
                <label for="product[{{$products->id}}]" class="label-checkbox-event-purpose">
                    {{ $products->translation($language)->first() ? $products->translation($language)->first()->name : '-' }}
                </label>
                &nbsp;
            @endforeach
        </div> --}}
        <select class="form-control select2" id="product" multiple="multiple" name="product[]" data-placeholder="@lang('event/event-create.product') maximum 3 options">
            @foreach($products as $products)
                <option value="{{$products->id}}" {{ multiselect( old('product'), $event->getProductIds(), $products->id) }}>{{ $products->translation($language)->first() ? $products->translation($language)->first()->name : '-' }}</option>
            @endforeach
        </select>
        @if ($errors->has('product'))
            <span class="help-block">
                <strong>{{ $errors->first('product') }}</strong>
            </span>
        @endif
    </div>
</div>

{{-- Attachment --}}
<div class="form-group{{ $errors->has('attachment') ? ' has-error' : '' }}">
    <label for="attachment" class="col-md-4 control-label">
        <span>
            @lang('event/event-create.attachment')
        </span>
    </label>
    <div class="col-md-8">
        <input id="attachment" type="file" class="form-control" name="attachment" value="{{ old('attachment') }}" accept="application/pdf" required autofocus>
        <small style="color:grey;">only PDF format are accepted (max 1MB)</small>
        @include('layouts.error_helpbox', ['data' => 'attachment'])
    </div>
</div>

{{-- Pakta Integritas --}}
<div class="form-group{{ $errors->has('pakta') ? ' has-error' : '' }}">
    <label for="pakta" class="col-md-4 control-label">
        <span>
            @lang('event/event-create.pakta')
        </span>
    </label>
    <div class="col-md-8">
        <input id="pakta" type="file" class="form-control" name="pakta" value="{{ old('pakta') }}" accept="application/pdf" required autofocus>
        <small style="color:grey;">only PDF format are accepted (max 1MB)</small>
        @include('layouts.error_helpbox', ['data' => 'pakta'])
    </div>
</div>

{{-- Note / Catatan --}}
<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
    <label for="description" class="col-md-4 control-label">
        <span>
            @lang('event/event-create.note')
        </span>
    </label>
    <div class="col-md-8">
        <textarea  id="description" class="form-control" name="description" required autofocus>{{ val(old('description'), $event->description) }}</textarea>
        @include('layouts.error_helpbox', ['data' => 'description'])
    </div>
</div>
