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
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <i class="ti-plus"></i> Create Event Product
                </h4>
                <p class="category">Create new event Product</p>
            </div>

            {{-- card-header --}}
            <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.store_event') }}">
                <div class="card-content">
                    <div class="row">
                    {{ csrf_field() }}
                    <div class="col-md-6">
                        <h4>Person In Charge (P.I.C)</h4>
                        <hr>

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">
                                Name
                                <i class="fa fa-user" aria-hidden="true"></i>
                            </label>
                            <div class="col-md-8">
                                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') ? old('username') : Auth::user()->name }}" required autofocus>
                                @include('layouts.error_helpbox', ['data' => 'username'])
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('contact') ? ' has-error' : '' }}">
                            <label for="contact" class="col-md-4 control-label">
                                Contact
                                <i class="fa fa-phone" aria-hidden="true"></i>
                            </label>
                            <div class="col-md-8">
                                <input id="contact" size="13" maxlength="13" type="text" onkeypress="numberOnly(event)" class="form-control" name="contact" value="{{ old('contact') ? old('contact') : Auth::user()->mobile_number }}" required autofocus>
                                @include('layouts.error_helpbox', ['data' => 'contact'])
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">
                                Email
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                            </label>
                            <div class="col-md-8">
                                <input id="email" type="text" class="form-control" name="email" value="{{ old('email') ? old('email') : Auth::user()->email  }}" required autofocus>
                                @include('layouts.error_helpbox', ['data' => 'email'])
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('university') ? ' has-error' : '' }}">
                            <label for="university" class="col-md-4 control-label">
                                University
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                            </label>
                            <div class="col-md-8">
                                <input id="university" type="text" class="form-control" name="university" value="{{ old('university') ? old('university') : Auth::user()->university  }}" required autofocus>
                                @include('layouts.error_helpbox', ['data' => 'university'])
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('faculty') ? ' has-error' : '' }}">
                            <label for="faculty" class="col-md-4 control-label">
                                Email
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                            </label>
                            <div class="col-md-8">
                                <input id="faculty" type="text" class="form-control" name="faculty" value="{{ old('faculty') ? old('faculty') : Auth::user()->faculty  }}" required autofocus>
                                @include('layouts.error_helpbox', ['data' => 'faculty'])
                            </div>
                        </div>
                        
                    </div>{{-- col-md-6 --}}

                    <div class="col-md-6">
                        <h4>Event Details</h4>
                        <hr>

                        {{-- Tipe Event --}}
                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">
                                <span>
                                    @lang('event/event-create.types')
                                </span>
                                <i class="fa fa-building" aria-hidden="true"></i>
                            </label>
                            <div class="col-md-8">
                                <select id="type" class="form-control" name="type">
                                    <option value="" {{old('type') == '' ? 'selected' : ''}}> -- Pilih Type -- </option>
                                    @foreach($types as $type)
                                        <option value="{{ $type->name }}" {{old('type') == $type->name ? 'selected' : ''}}>
                                        {{ is_null($type->translation($language)->first()) ? $type->name : $type->translation($language)->first()->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @include('layouts.error_helpbox', ['data' => 'university'])
                            </div>
                        </div>


                        {{-- Event Title / Judul Event--}}
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">
                                <span>Event Purpose</span>
                                <i class="fa fa-lightbulb-o" aria-hidden="true"></i>
                            </label>
                            <div class="col-md-8">
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required>
                                @include('layouts.error_helpbox', ['data' => 'title'])
                            </div>
                        </div>


                        {{-- Tujuan Event --}}
                        <div class="form-group [ form-group ] {{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">
                                <span>Event Destination</span>
                                <i class="fa fa-lightbulb-o" aria-hidden="true"></i>
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
                                <select class="form-control select2"  id="purpose" multiple="multiple" name="purpose[]" data-placeholder="Choose purpose maximum 3 options">
                                    @foreach($purposes as $purpose)
                                        <option value="{{$purpose->id}}">{{ $purpose->translation($language)->first() ? $purpose->translation($language)->first()->name : '-' }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        {{--  Event Product --}}
                        <div class="form-group [ form-group ] {{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">
                                <span>Product of Interest</span>
                                <i class="fa fa-lightbulb-o" aria-hidden="true"></i>
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
                                <select class="form-control select2" id="product" multiple="multiple" name="product[]" data-placeholder="Choose interest maximum 5 options">
                                    @foreach($products as $products)
                                        <option value="{{$products->id}}">{{ $products->translation($language)->first() ? $products->translation($language)->first()->name : '-' }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
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
                                <i class="fa fa-calculator" aria-hidden="true"></i>
                            </label>
                            <div class="col-md-8">
                                <input id="attachment" type="file" class="form-control" name="attachment" value="{{ old('attachment') }}" accept=".csv,.xls,.xlsx,.doc,.docx,.txt" autofocus>
                                <small style="color:grey;">Fill this with : .csv/.xlsx/.docx/.txt</small>
                                @include('layouts.error_helpbox', ['data' => 'attachment'])
                            </div>
                        </div>

                        {{-- Note / Catatan --}}
                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">
                                <span>Note</span>
                                <i class="fa fa-sticky-note" aria-hidden="true"></i>
                            </label>
                            <div class="col-md-8">
                                <textarea  id="description" class="form-control" name="description" required autofocus>{{ old('description') }}</textarea>
                                @include('layouts.error_helpbox', ['data' => 'description'])
                            </div>
                        </div>
                    </div>{{-- col-md-6 --}}
                    </div>
                </div>
                <div class="card-footer">
                    <div class="form-group text-center">
                            <a href="{!! route('admin.event.index') !!}" class="btn btn-md btn-red">
                                <i class="fa fa-caret-left"></i>
                                Back
                            </a><button type="submit" class="btn btn-md btn-red">
                                <i class="fa fa-paper-plane-o"></i>
                                Propose
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $('#province_id').change(function()
        {
            $.get('/api/city/' + this.value + '/province.json', function(cities)
            {
                var $city = $('#city_id');
                $city.find('option').remove().end();
                $.each(cities, function(index, city) {
                    $city.append('<option value="' + city.id  + '">' + city.name + '</option>');
                });
            });
        });

        $(document).ready(function() {
            $(".province_id option[value='0']").attr("disabled","disabled");
            $(".city_id option[value='0']").attr("disabled","disabled");
        });
        var limit = 3;
        $('input.checkbox-event-purpose-dds').on('change', function(evt) {
           if($(this).siblings(':checked').length >= limit) {
               this.checked = false;
           }
        });
        var tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + {!!empty($minDate) ? '' : $minDate !!});
        var disabledDate=[{!!empty($disableddate) ? '' : $disableddate !!}{!!empty($eventapproved) ? '' : ','.$eventapproved !!}];
        var datePicker =(function(){
            $('#datepicker').datepicker({
                minDate: tomorrow,
                setDate: tomorrow,
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true,
                beforeShowDay: function(date){
                    var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
                    var day = date.getDay();
                    return [ disabledDate.indexOf(string) == -1 && day != 0 && day != 6 ]
                },
            });
        })();
    </script>
@endsection
