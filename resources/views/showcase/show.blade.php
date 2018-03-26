@extends('layouts.main.telkom')

@section('content')
  <section class="content">
    <div class="container">
      <div class="row">
        <!-- Blog Post Content Column -->
          <!-- Blog Post -->
          <!-- Title -->
          <center>
            
          <h1>{{$showcase->title}}</h1>

          <?php $data_id=$showcase->showcase_id; ?>
          <!-- Author -->
          {{-- <p class="lead">
            by <a href="javascript:void(0)">{{$showcase->showcase->author ? $showcase->showcase->author->name : 'Admin'}}</a> | {{$showcase->comments->count()}} Comment | 
            <a href="javascript:void(0)">{{!is_null($showcase->showcase->category->has('translation')->first()) ? ($showcase->showcase->category->translation($language)->first() ? $showcase->showcase->category->translation($language)->first()->name : $showcase->showcase->category->name) : ($showcase->showcase->category ? $showcase->showcase->category->name : "N/A")}} </a>
          </p> --}}
          <!-- Date/Time -->
          <p><span class="glyphicon glyphicon-time"></span> 
            Posted on {{date_format($showcase ->created_at,"d, F Y H:i A")}}</p>

          <hr>

          <!-- Preview Image -->
          <img class="img-responsive" src="{{$showcase ->showcase->image ? (file_exists($_SERVER['DOCUMENT_ROOT'].$showcase ->showcase->image->url('notzoom')) ? $showcase ->showcase->image->url('notzoom') : '/assets/img/gallery/1200x900/1.jpg') : '/assets/img/gallery/1200x900/1.jpg'}}" 
            style="width: 40%;" alt="">

          <hr>

          </center>
          <!-- Post Content -->
          {!! $showcase ->content !!}

          <hr>
          <!-- Blog Share -->
          <div class="well">
            <h4>Share on : </h4>
            <div class="social-buttons">
              <a id="fb-share" href="#" class="btn-share">
                <i class="fa fa-facebook-official fa-2x"></i>
              </a>
              <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}"
               target="_blank" class="btn-share">
                <i class="fa fa-twitter-square fa-2x"></i>
              </a>
              <a href="https://plus.google.com/share?url={{ urlencode(request()->fullUrl()) }}"
               target="_blank" class="btn-share" onclick="countShare()" onendinteraction="countShare" >
               <i class="fa fa-google-plus-square fa-2x"></i>
             </a>
            </div>
          </div>
         <!-- Blog Comments -->

          <!-- Comments Form -->
          <div class="well">
            <h4>Leave a Comment:</h4>
            @if(Auth::check())
              {!! Form::open(array('url'=>route('comment_showcase',$showcase ->id),'method'=>'POST', 'id'=>'myform', 'class'=>'form-horizontal')) !!}
                <div class="form-group">
                  <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
                </div>
                <div class="form-group">
                  {!! app('captcha')->display(['data-callback'=>'enableButton']) !!}
                </div>
                <div class="form-group">
                  {!! Form::submit('send comment',['class'=>'btn red-thunderbird uppercase disable-button','disabled'=>true]) !!}
                </div>
              {!! Form::close() !!}
            @else
              <a href="{{ route('login-register') }}">Please login to comment</a>
            @endif
          </div>

          <hr>

          <!-- Posted Comments -->

          @foreach($showcase ->comments as $comment)
            <!-- Comment -->
            <div class="media">
              <a class="pull-left" href="#">
                <img class="media-object" src="http://placehold.it/64x64" alt="">
              </a>
              <div class="media-body">
                <h4 class="media-heading">{{$comment->commented->name}}
                  <small>{{$comment->created_at}}</small>
                </h4>
                {{$comment->comment}}
              </div>
            </div>
          @endforeach
      </div>
      <!-- /.row -->
      <hr>
    </div>
  </section>

  <div id="fb-root"></div>

@endsection

@section('script')
  <script src="https://apis.google.com/js/platform.js" async defer></script>

  <script>

    (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v2.9";
      fjs.parentNode.insertBefore(js, fjs);
    }
    (document, 'script', 'facebook-jssdk'));
    window.___gcfg = {
      lang: 'en-US',
      parsetags: 'onload',
    };
    document.getElementById('fb-share').onclick = function() {
      FB.ui(
      {
        appId: '845754832257201',
        method: 'feed',
        display: 'popup',
        href: '{{ urlencode(request()->fullUrl()) }}',
        mobile_iframe:true
      },
      function(response) {
        if (response && response.post_id) {
          countShare();
        } else {
          console.log('Post was not shared.');
        }
      }
      );
    }

    window.twttr = (function (d,s,id) {
      var t, js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return; js=d.createElement(s); js.id=id;
      js.src="https://platform.twitter.com/widgets.js"; fjs.parentNode.insertBefore(js, fjs);
      return window.twttr || (t = { _e: [], ready: function(f){ t._e.push(f) } });
    }(document, "script", "twitter-wjs"));
    twttr.ready(function (twttr) {
      twttr.events.bind('tweet', function (event) {
        countShare();
      });
    });

    function countShare(){
      var showcase_id='{{ $data_id}}';
      $.ajax({
        url: "{!! route('showcase.count_share')!!}",
        type:'POST',
        data:{id:showcase_id},
        async: true,
        success:function(resp){
          console.log(resp);
        }
      });
    }
    function enableButton(){
      $('.disable-button').removeAttr('disabled');
    }
    var popupSize = {
      width: 780,
      height: 550
    };
    $(document).on('click', '.social-buttons > a', function(e){

      var verticalPos = Math.floor(($(window).width() - popupSize.width) / 2),
      horisontalPos = Math.floor(($(window).height() - popupSize.height) / 2);

      var popup = window.open($(this).prop('href'), 'social',
        'width='+popupSize.width+',height='+popupSize.height+
        ',left='+verticalPos+',top='+horisontalPos+
        ',location=0,menubar=0,toolbar=0,status=0,scrollbars=1,resizable=1');

      if (popup) {
        popup.focus();
        e.preventDefault();
      }

    });
  </script>
@endsection