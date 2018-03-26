<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

  <head>
    <base href="{{URL::asset('/')}}" target="_top">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Telkom DDS</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/dds.css" rel="stylesheet">
    <link href="css/nivo-lightbox.css" rel="stylesheet">
    <link href="{{url('css/nivo_themes/default/default.css')}}" rel="stylesheet">
    <link href="css/templatemo-style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">

    <!-- Important Owl stylesheet -->
    <link rel="stylesheet" href="css/owl.carousel.css">
    
    <!-- Default Theme -->
    <link rel="stylesheet" href="css/owl.theme.css">
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <!-- jQuery Version 1.11.1 -->
    <script src="{{url('js/jquery.js')}}"></script>
    
    <!-- Bootstrap Core JavaScript -->
    <script src="{{url('js/bootstrap.min.js')}}"></script>
    <script src="js/nivo-lightbox.min.js"></script> 
    {{-- <script src="js/custom.js"></script> --}}
    <script src="js/jquery.nav.js"></script> 
    
    <!-- Start of kaveinhelp Zendesk Widget script -->
    <script>/*<![CDATA[*/window.zEmbed||function(e,t){var n,o,d,i,s,a=[],r=document.createElement("iframe");window.zEmbed=function(){a.push(arguments)},window.zE=window.zE||window.zEmbed,r.src="javascript:false",r.title="",r.role="presentation",(r.frameElement||r).style.cssText="display: none",d=document.getElementsByTagName("script"),d=d[d.length-1],d.parentNode.insertBefore(r,d),i=r.contentWindow,s=i.document;try{o=s}catch(e){n=document.domain,r.src='javascript:var d=document.open();d.domain="'+n+'";void(0);',o=s}o.open()._l=function(){var e=this.createElement("script");n&&(this.domain=n),e.id="js-iframe-async",e.src="https://assets.zendesk.com/embeddable_framework/main.js",this.t=+new Date,this.zendeskHost="kaveinhelp.zendesk.com",this.zEQueue=a,this.body.appendChild(e)},o.write('<body onload="document._l();">'),o.close()}();
    /*]]>*/</script>
    <!-- End of kaveinhelp Zendesk Widget script -->
    
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script type="text/javascript">
      function setActive(input, evt){
        $('button.filter-button').removeClass('active');
        $(input).addClass('active');    
      }
    </script>
  </head>

  <body>
    <!-- HEADER -->
    @include('partials.header')

    <!-- CONTENT -->

    @yield('content')

    @include('partials.footer')

    <!-- Include js plugin -->
    <script src="{{url('js/owl.carousel.js')}}"></script>

    <script type="text/javascript">
      // $(function () {
      //   $('a[href="#search"]').on('click', function(event) {
      //     event.preventDefault();
      //     $('#search').addClass('open');
      //     $('#search > form > input[type="search"]').focus();
      //   });
        
      //   $('#search, #search button.close').on('click keyup', function(event) {
      //     if (event.target == this || event.target.className == 'close' || event.keyCode == 27) {
      //       $(this).removeClass('open');
      //     }
      //   });
      // });
    </script>

    <script type="text/javascript">
      $(document).ready(function() {
        $("#owl-demo").owlCarousel({
          autoPlay: 3000, //Set AutoPlay to 3 seconds
          items : 5,
          itemsDesktop : [1199,3],
          itemsDesktopSmall : [979,3],
          pagination : false
        });
      });
    </script>

    <script type="text/javascript">
      $(document).ready(function(){

          $(".filter-button").click(function(){
              var value = $(this).attr('data-filter');
              
              if(value == "all")
              {
                  //$('.filter').removeClass('hidden');
                  $('.filter').show('1000');
              }
              else
              {
      //            $('.filter[filter-item="'+value+'"]').removeClass('hidden');
      //            $(".filter").not('.filter[filter-item="'+value+'"]').addClass('hidden');
                  $(".filter").not('.'+value).hide('3000');
                  $('.filter').filter('.'+value).show('3000');
                  
              }
          });

      });
    </script>

  </body>

</html>