@extends('layouts.main.telkom')
@section('title')
  <title>Telkom DDS | Message</title>
@endsection
@section('style')
    <style type="text/css">
        span#emailStatus{
            margin-top: 22px;
        }
    </style>
@endsection

@section('content')
<div class="page-wrapper">
    <div class="page-wrapper-row full-height">
        <div class="page-wrapper-middle">
            <div class="page-container">
                <div class="page-content-wrapper">
                    <div class="page-content">
                        <div class="container">
                            @include('flash::message')
                            <div class="page-content-inner">
                                <div class="c-content-feedback-1 c-option-1">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="c-contact">
                                                <div class="c-content-title-1">
                                                    <h3 class="uppercase">@lang('contact.inquiry.title')</h3>
                                                    <div class="c-line-left bg-dark"></div>
                                                </div>
                                                @if (count($errors) > 0)
                                                    <div class="alert alert-danger">
                                                        <strong>Whoops!</strong> There were some problems with your input.<br /><br />
                                                        <ul>
                                                            @foreach ($errors->all() as $error)
                                                                <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                                <form method="POST" action="{{route('message_page')}}" id="myform" enctype="multipart/form-data" class="form-horizontal">
                                                    {{ csrf_field() }}
                                                    <label></label>
                                                    <div>
                                                        <input class="form-control placeholder-no-fix" minlength="5" maxlength="30" type="text" placeholder="@lang('contact.inquiry.name')" value="{{ Auth::user() ? Auth::user()->name : '' }}" name="name" required/>
                                                    </div>

                                                    <div>
                                                        <label class="col-sm-2 control-label"></label>
                                                        <div>
                                                            <input class="form-control placeholder-no-fix" type="text" placeholder="@lang('contact.inquiry.email')" value="{{ Auth::user() ? Auth::user()->email : '' }}" name="email" required/></span>
                                                        </div>
                                                    </div>

                                                    <div>
                                                        <label></label>
                                                        <div>
                                                            <select class="form-control border-input" name="subject" required>
                                                                <option value=""> -- Select Subject -- </option>
                                                                <option value="ConfirmApprove"> @lang('contact.inquiry.confirmapprove')</option>
                                                                <option value="ConfirmInterview">@lang('contact.inquiry.confirminterview')</option>
                                                                <option value="Reschedule">@lang('contact.inquiry.reschedule')</option>
                                                                <option value="Other">@lang('event/event-create.other')</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div>
                                                        <label></label>
                                                        <div>
                                                            <textarea name="message" id="" class="form-control placeholder-no-fix span6" placeholder="@lang('contact.inquiry.message')" style="/*width: 557px;*/ height: 208px;"></textarea>
                                                        </div>
                                                    </div>

                                                    <div>
                                                        <label></label>
                                                        <div>
                                                            {!! app('captcha')->display( ['data-callback'=>'enableButton']) !!}
                                                        </div>
                                                    </div>

                                                    <div>
                                                        <label></label>
                                                        <div>
                                                            <button class="btn red-thunderbird uppercase disable-button" disabled=true>
                                                                <i class="ti-check"></i>
                                                                @lang('contact.inquiry.submit')
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
function enableButton(){
    $('.disable-button').removeAttr('disabled');
}
</script>

<script>
    // This example requires the Places library. Include the libraries=places
    // parameter when you first load the API. For example:
    // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 13,
            center: {lat: -6.8712817, lng: 107.5859684}
        });

        var infowindow = new google.maps.InfoWindow();
        var service = new google.maps.places.PlacesService(map);

        service.getDetails({
            placeId: "ChIJs_nuyJDmaC4R79DifAqdarQ"
        }, function(place, status) {
            if (status === google.maps.places.PlacesServiceStatus.OK) {
                var marker = new google.maps.Marker({
                    map: map,
                    position: place.geometry.location
                });
                google.maps.event.addListener(marker, 'click', function() {
                    infowindow.setContent('<div><strong>' + place.name + '</strong><br>' +
                        place.formatted_address + '</div>');
                    infowindow.open(map, this);
                });
            }
        });
    }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAPS_KEY')}}&libraries=places&callback=initMap"></script>
@endsection