@extends('layouts.main.telkom')
@section('title')
  <title>Telkom DDS | Contact Us</title>
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
                                <div class="c-content-contact-1 c-opt-1">
                                    <div class="row" data-auto-height=".c-height">
                                        <div class="col-lg-8 col-md-6 c-desktop"></div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="c-body">
                                                <div class="c-section">
                                                    <h3>Divisi Digital Service</h3>
                                                </div>

                                                <div class="c-section">
                                                    <div class="c-content-label uppercase bg-red-thunderbird">@lang('contact.inquiry.address')</div>
                                                    <p>Jalan Gegerkalong Hilir No. 47
                                                    Sukarasa, Sukasari, Bandung City, West Java 40152, Indonesia</p>
                                                </div>

                                                <div class="c-section">
                                                    <div class="c-content-label uppercase bg-red-thunderbird">@lang('contact.inquiry.contact')</div>
                                                    <p>SENDYLENVI REGIA</p>
                                                    <p><span class="glyphicon glyphicon-earphone"></span> 081-2217-1155</p>
                                                </div>
                                                <div class="c-section">
                                                    <div class="c-content-label uppercase bg-red-thunderbird">@lang('contact.inquiry.social')</div>
                                                    <br/>
                                                    <ul class="c-content-iconlist-1 ">
                                                        <li>
                                                            <a href="https://twitter.com/telkom?lang=id"><i class="fa fa-twitter"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href="https://id-id.facebook.com/telkomcare/"><i class="fa fa-facebook"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href="#"><i class="fa fa-youtube-play"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="map" class="c-content-contact-1-gmap" style="height: 650px;"></div>
                                </div>
                                {{--<div class="c-content-feedback-1 c-option-1">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="c-container bg-red-thunderbird">
                                                <div class="c-content-title-1 c-inverse">
                                                    <h3 class="uppercase">@lang('contact.faq.title')</h3>
                                                    <div class="c-line-left"></div>
                                                    <p class="c-font-lowercase">@lang('contact.faq.wording')</p>
                                                    <p>&nbsp;</p>
                                                    <button class="btn grey-cararra font-dark">@lang('contact.faq.more_button')</button>
                                                </div>
                                            </div>

                                            <div class="c-content-title-1 c-inverse">
                                                <h3 class="uppercase">Have a question?</h3>
                                                <div class="c-line-left"></div>
                                                <form action="#">
                                                <div class="input-group input-group-lg c-square">
                                                    <input type="text" class="form-control c-square" placeholder="Ask a question" />
                                                    <span class="input-group-btn">
                                                    <button class="btn grey-cararra font-dark uppercase" type="button">Go!</button>
                                                    </span>
                                                </div>
                                                </form>
                                                <p>Ask your questions away and let our dedicated customer service help you look through our FAQs to get your questions answered!</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="c-contact">
                                                <div class="c-content-title-1">
                                                    <h3 class="uppercase">@lang('contact.inquiry.title')</h3>
                                                    <div class="c-line-left bg-dark"></div>
                                                    <p class="c-font-lowercase">@lang('contact.inquiry.wording')</p>
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
                                                <form method="POST" action="{{route('contact_page')}}" id="myform" enctype="multipart/form-data" class="form-horizontal">
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
                                                            <input class="form-control placeholder-no-fix" type="text" placeholder="@lang('contact.inquiry.subject')" name="subject" required/>
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
                                        </div>--}}
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