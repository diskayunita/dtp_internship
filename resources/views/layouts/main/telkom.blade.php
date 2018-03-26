<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        @yield('title')
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />

        @yield('meta')

        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="{{ mix('/css/telkom-dtp.css') }}">

        <link rel="icon" type="image/png" href="{{asset('assets/img/favicon.png')}}" />

        @yield('style')

        <!--Start of Zendesk Chat Script-->
        <script type="text/javascript">
        window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
        d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
        _.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
        $.src="https://v2.zopim.com/?4tGl5zujBecZ8Q172nJqeNKW4bAxZkcS";z.t=+new Date;$.
        type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
        </script>
        <!--End of Zendesk Chat Script-->

        @if(!empty(env('GOOGLE_ANALYTICS', '')))
            <script>(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o), m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');ga('create', '{!! env('GOOGLE_ANALYTICS', '') !!}', 'auto');ga('send', 'pageview');</script>
        @endif

        <script src="{{mix('/js/telkom-dtp.js')}}" type="text/javascript"></script>
    </head>

    <body class="page-container-bg-solid page-header-menu-fixed">
        <div class="page-wrapper">
            <div class="page-wrapper-row">
                @include('layouts.main.partials.header')
            </div>

            <div class="page-wrapper-row full-height">
                <div class="page-wrapper-middle">
                    <div class="page-container">
                    <div class="page-content-wrapper">
                        {{-- @include('flash::message') --}}
                        @yield('content')
                    </div>
                    </div>
                </div>
            </div>

            <div class="page-wrapper-row">
                @include('layouts.main.partials.bottom')
            </div>
        </div>
        
        <script>
            function resizeCarouselCaption() {
                var screen = $(this).width();
                var calc = screen / 1366;
                calc = Math.round(calc*100)/100;
                $('.carousel-caption').css('zoom',calc);
            }
            
            $(window).resize(function() {
                resizeCarouselCaption();
            });
            $(document).ready(function() {
                resizeCarouselCaption();
                var date = new Date();
                var d = date.getDate();
                var m = date.getMonth();
                var y = date.getFullYear();

                /*  className colors

                className: default(transparent), important(red), chill(pink), success(green), info(blue)

                */


                /* initialize the external events
                -----------------------------------------------------------------*/

                $('#external-events div.external-event').each(function() {

                    // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                    // it doesn't need to have a start or end
                    var eventObject = {
                        title: $.trim($(this).text()) // use the element's text as the event title
                    };

                    // store the Event Object in the DOM element so we can get to it later
                    $(this).data('eventObject', eventObject);

                    // make the event draggable using jQuery UI
                    $(this).draggable({
                        zIndex: 999,
                        revert: true,      // will cause the event to go back to its
                        revertDuration: 0  //  original position after the drag
                    });

                });


                /* initialize the calendar
                -----------------------------------------------------------------*/

                var calendar =  $('#calendar').fullCalendar({
                    header: {
                        left: 'title',
                        center: 'agendaDay,agendaWeek,month',
                        right: 'prev,next today'
                    },
                    disableDragging: true,
                    editable: true,
                    firstDay: 1, //  1(Monday) this can be changed to 0(Sunday) for the USA system
                    selectable: true,
                    defaultView: 'month',
                    axisFormat: 'h:mm',
                    columnFormat: {
                        month: 'ddd',    // Mon
                        week: 'ddd d', // Mon 7
                        day: 'dddd M/d',  // Monday 9/7
                        agendaDay: 'dddd d'
                    },
                    titleFormat: {
                        month: 'MMMM yyyy', // September 2009
                        week: "MMMM yyyy", // September 2009
                        day: 'MMMM yyyy'                  // Tuesday, Sep 8, 2009
                    },
                    allDaySlot: false,
                    selectHelper: true,
                    select: function(start, end, allDay) {
                        var day = new Date(start);
                        if(day.getDay() == 6 || day.getDay() == 0) {
                          alert('Hari Libur !');
                        } else {
                          var title = prompt('Event Title:');
                          if (title) {
                            calendar.fullCalendar('renderEvent',
                              {
                                title: title,
                                start: start,
                                end: end,
                                allDay: allDay
                              },
                              true // make the event "stick"
                            );
                          }
                          calendar.fullCalendar('unselect');
                        }
                    },
                    droppable: true, // this allows things to be dropped onto the calendar !!!
                    drop: function(date, allDay) { // this function is called when something is dropped

                        // retrieve the dropped element's stored Event Object
                        var originalEventObject = $(this).data('eventObject');

                        // we need to copy it, so that multiple events don't have a reference to the same object
                        var copiedEventObject = $.extend({}, originalEventObject);

                        // assign it the date that was reported
                        copiedEventObject.start = date;
                        copiedEventObject.allDay = allDay;

                        // render the event on the calendar
                        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

                        // is the "remove after drop" checkbox checked?
                        if ($('#drop-remove').is(':checked')) {
                            // if so, remove the element from the "Draggable Events" list
                            $(this).remove();
                        }
                    },

                    events: [
                        @foreach(findEventApproved() as $ea) 
                            {
                                id: '{{ $ea->id }}',
                                title: '{{ $ea->agencyname }}',
                                start: '{{ date("Y-m-d", strtotime($ea->start_date) ) }}'
                            },
                        @endforeach
                    ],
                });

                $('#province_id').bind('change', function () {
                    $.get('/api/city/' + this.value + '/province.json', function(cities) {
                        var $city = $('#city_id');

                        $city.find('option').remove().end();

                        $.each(cities, function(index, city) {
                            $city.append('<option value="' + city.id  + '">' + city.name + '</option>');
                        });
                    });
                });

                $('#province_id').trigger('change');
            });

        </script>
        <script src="{{asset('assets/js/galeri.js')}}" type="text/javascript"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $("#dtBox").DateTimePicker({
                    dateFormat: "yyyy-MM-dd"
                });
                $(document).ready(function() {
            $('.gallery').magnificPopup({
                    delegate: 'a',
                    type: 'image',
                    tLoading: 'Loading image #%curr%...',
                    mainClass: 'mfp-img-mobile',
                    gallery: {
                        enabled: true,
                        navigateByImgClick: true,
                        preload: [0,1] // Will preload 0 - before current, and 1 after the current image
                    },
                    image: {
                        tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
                        titleSrc: function(item) {
                            return item.el.attr('title') + '<small>by Marsel Van Oosten</small>';
                        }
                    }
                });
            });
            });
        </script>

        <script type="text/javascript">
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#image')
                            .attr('src', e.target.result)
                            .width(300)
                            .height(300);
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>

        <script>
            $(document).ready(function() {
                $("#owl-demo").owlCarousel({
                    autoPlay: 3000, //Set AutoPlay to 3 seconds
                    items : 5,
                    itemsDesktop : [1199,3],
                    itemsDesktopSmall : [979,3],
                    pagination : true,
                    nav:true,
                });

                $(".province_id option[value='0']").attr("disabled","disabled");
                $(".city_id option[value='0']").attr("disabled","disabled");
            });
        </script>

        <script type="text/javascript">
            var purpose = 3;
            $('input.checkbox-event-purpose-dds').on('change', function(evt) {
                if($(this).siblings(':checked').length >= purpose) {
                    this.checked = false;
                }
            });

            var product = 5;
            $('input.checkbox-event-product-dds').on('change', function(evt) {
                if($(this).siblings(':checked').length >= product) {
                    this.checked = false;
                }
            });

            // $(".purpose2").select2();
            $("#purpose").select2({
                maximumSelectionLength: 3
            });
            
            $("#product").select2({
                maximumSelectionLength: 5
            });
            
            function numberOnly(evt) {
                var theEvent = evt || window.event;
                var key = theEvent.keyCode || theEvent.which;
                key = String.fromCharCode(key);
                var regex = /[0-9]/;
                if( evt.keyCode >= 37 && evt.keyCode <= 40 ) {
                    return;
                }
                if( evt.keyCode === 8 || evt.keyCode === 46 || evt.keyCode === 13 || evt.keyCode === 32 ) {
                    return;
                }
                if (!regex.test(key)) {
                    theEvent.returnValue = false;
                    if (theEvent.preventDefault) theEvent.preventDefault();
                }
            }

            function alphabetOnly(evt) {
                var theEvent = evt || window.event;
                var key = theEvent.keyCode || theEvent.which;
                key = String.fromCharCode(key);
                var regex = /[A-Za-z]/;
                
                if( evt.keyCode >= 37 && evt.keyCode <= 40 ) {
                    return; // arrow keys
                }
                if( evt.keyCode === 8 || evt.keyCode === 46 || evt.keyCode === 13 || evt.keyCode === 32 ) {
                    return; // backspace / delete
                }

                if (!regex.test(key)) {
                    theEvent.returnValue = false;
                    if (theEvent.preventDefault) theEvent.preventDefault();
                }
            }

            $('.email').on('keypress',function() {
                var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
                if (testEmail.test(this.value)){
                    $('span#emailStatus').addClass('hide');
                } else {
                    $('span#emailStatus').removeClass('hide');
                }
            });
        </script>        
        @yield('script')
    </body>
</html>
