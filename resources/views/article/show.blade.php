@extends('layouts.main.telkom')

@section('content')
  <section class="content">
    <div class="container">
      <div class="row">
        <!-- Blog Post Content Column -->
        <div class="col-lg-8">
          <!-- Blog Post -->
          <!-- Title -->
          <h1>{{$article->title}}</h1>

          <?php $data_id=$article->article_id; ?>
          <!-- Author -->
          <p class="lead">
            by <a href="javascript:void(0)">{{$article->article->author ? $article->article->author->name : 'Admin'}}</a> | {{$article->comments->count()}} Comment | 
            <a href="javascript:void(0)">{{!is_null($article->article->category->has('translation')->first()) ? ($article->article->category->translation($language)->first() ? $article->article->category->translation($language)->first()->name : $article->article->category->name) : ($article->article->category ? $article->article->category->name : "N/A")}} </a>
          </p>

          <hr>

          <!-- Date/Time -->
          <p><span class="glyphicon glyphicon-time"></span> 
            Posted on {{date_format($article->created_at,"d, F Y H:i A")}}</p>

          <hr>

          <!-- Preview Image -->
          <img class="img-responsive" src="{{$article->article->image ? (file_exists($_SERVER['DOCUMENT_ROOT'].$article->article->image->url()) ? $article->article->image->url() : '/assets/img/gallery/1200x900/1.jpg') : '/assets/img/gallery/1200x900/1.jpg'}}" 
            style="width: 900px;" alt="">

          <hr>

          <!-- Post Content -->
          {!! $article->content !!}

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
              <form method="POST" action="{{route('comment_article',$article->id)}}" id="myform" enctype="multipart/form-data" class="form-horizontal">
              {{ csrf_field() }}
                <div class="form-group">
                  <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
                </div>
                <div class="form-group">
                  <!-- <div class="g-recaptcha" data-callback="enableButton" data-sitekey="6Le-syUUAAAAAPH-cwnj1yWL_3JeGOzCPK9f5qU_"></div> -->
                  {!! app('captcha')->display( ['data-callback'=>'enableButton']) !!}
                </div>
                <div class="form-group">
                  <button class="btn red-thunderbird uppercase disable-button" disabled=true>
                    <i class="ti-check"></i>
                    @lang('contact.inquiry.submit')
                  </button>
                </div>
              </form>
            @else
              <a href="{{ route('login-register') }}">Please login to comment</a>
            @endif
          </div>

          <hr>

          <!-- Posted Comments -->

          @foreach($article->comments as $comment)
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
        </div>{{-- /.col-md-8 --}}

        <!-- Article Sidebar Widgets Column -->
        <div class="col-md-4">
          <div>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs nav-justified" role="tablist">
              <li role="presentation" class="active">
                <a href="#recent" aria-controls="recent" role="tab" data-toggle="tab">@lang('general.recent')</a>
              </li>
              <li role="presentation">
                <a href="#popular" aria-controls="popular" role="tab" data-toggle="tab">@lang('general.popular')</a>
              </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane active" id="recent">
                @foreach($recent as $key => $data)
                <?php
                  $image = $data->image ? (file_exists($_SERVER['DOCUMENT_ROOT'].$data->image->url('original')) ? $data->image->url() : '/assets/img/gallery/1200x900/'.$key.'.jpg') : '/assets/img/gallery/1200x900/'.$key.'.jpg';
                  $title = $data->translation($language)->first() ? $data->translation($language)->first()->title : 'N/A';
                  $image_desc = $data->translation($language)->first() ? $data->translation($language)->first()->image_desc : 'N/A';
                ?>

                <div class="list-article">
                  <div class="col-xs-4 nopadding">
                    <div class="img-thumb" style="background: url('{{ url($image) }}');"></div>
                  </div>
                  <div class="col-xs-8 grey-bg">
                    <div class="desc-box">
                      <a class="article-nav" href="{{route('single-article',$data->translation($language)->first()->slug )}}">
                        <h5>{{ str_limit($title, 35)  }}</h5>
                      </a>
                      <p>{{  str_limit($image_desc, 50) }}</p>
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
              <div role="tabpanel" class="tab-pane" id="popular">
                @foreach($popular as $key=>$data)
                  <?php
                    $image = $data->image->url() ? (file_exists($_SERVER['DOCUMENT_ROOT'].$data->image->url()) ? $data->image->url() : '/assets/img/gallery/1200x900/'.$key.'.jpg') : '/assets/img/gallery/1200x900/'.$key.'.jpg';
                    $title = $data->translation($language)->first() ? $data->translation($language)->first()->title : 'N/A';
                    $image_desc = $data->translation($language)->first() ? $data->translation($language)->first()->image_desc : 'N/A';
                  ?>

                  <div class="list-article">
                    <div class="col-xs-4 nopadding">
                      <div class="img-thumb" style="background: url('{{ url($image) }}');"></div>
                    </div>
                    <div class="col-xs-8 grey-bg">
                      <div class="desc-box">
                        <a class="article-nav" href="{{route('single-article',$data->translation($language)->first()->slug )}}">
                          <h5>{{ str_limit($title, 35)  }}</h5>
                        </a>
                        <p>{{  str_limit($image_desc, 50) }}</p>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->
      <hr>
    </div>
  </section>

  <div id="fb-root"></div>

@endsection

@section('meta')
    <meta property="og:url"                content="{{ request()->fullUrl() }}" />
    <meta property="og:title"              content="{{ $article->title }}" />
    <meta property="og:image"              content="{{ $article->article->image ?
    (file_exists($_SERVER['DOCUMENT_ROOT'].$article->article->image->url()) ? $article->article->image->url() : url('/assets/img/gallery/1200x900/1.jpg') ) : url('/assets/img/gallery/1200x900/1.jpg') }}" />
    <meta property="og:site_name"          content="Telkom DDS">
    <meta property="fb:app_id"             content="{{ env('FACEBOOK_CLIENT_ID', '1963503943884266') }}">
@endsection

@section('script')
  <script src="https://apis.google.com/js/platform.js" async defer></script>

  <script>

      window.fbAsyncInit = function() {
          FB.init({
              appId      : '{{ env('FACEBOOK_CLIENT_ID', '1963503943884266') }}',
              xfbml      : true,
              version    : 'v2.10'
          });
          FB.AppEvents.logPageView();
      };

      (function(d, s, id){
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) {return;}
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/en_US/sdk.js";
          fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));

      window.___gcfg = {
          lang: 'en-US',
          parsetags: 'onload',
      };
      document.getElementById('fb-share').onclick = function() {
          FB.ui(
              {
                  method: 'share',
                  display: 'popup',
                  href: '{{ request()->fullUrl() }}',
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
          var article_id='{{ $data_id}}';
          $.ajax({
              url: "{!! route('article.count_share')!!}",
              type:'POST',
              data:{id:article_id},
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