@extends('layouts.main.telkom')
@section('title')
  <title>Telkom DDS | News</title>
@endsection
@section('content')
<div class="page-head">
    <div class="container">
        <div class="page-title">

        </div>
        <div class="page-search">
          <!-- <form class="search-form" action="javascript:void(0)"> -->
          <form class="search-form" method="POST" action="{{ route('search-article') }}">
            <div class="input-group">
                {{ csrf_field() }}
                <input type="text" name="search" placeholder="@lang('general.search_article')" class="form-control" v-model="query" v-on:keyup.enter="searchArticle()">
                <span class="input-group-btn">
                  <a href="javascript::void()" class="btn submit" onclick="searchArticle()">
                    <i class="icon-magnifier"></i>
                  </a>
                </span>
            </div>
          </form>
        </div>
    </div>
</div>

<div class="page-content">
    <div class="container">
        <div class="page-content-inner">
            <div class="blog-page blog-content-2">
                <section class="publicaciones-blog-home">
                    <div class="">
                        <div class="row-page row">
                            <div id="article" class="col-sm-8">
                                @foreach($articles as $key=>$article)
                                    @if($key==0)
                                        <div class="col-page col-sm-8 col-md-8">
                                            <a href="{{ route('single-article',$article->translation($language)->first()->slug) }}" class="black fondo-publicacion-home">
                                                <div class="img-publicacion-principal-home">
                                                    <img class="img-responsive" src="{{$article->image->url('original') ? (file_exists($_SERVER['DOCUMENT_ROOT'].$article->image->url('original')) ? $article->image->url('original') : '/assets/img/gallery/1200x900/'.$key++.'.jpg') : '/assets/img/gallery/1200x900/'.$key++.'.jpg'}}">
                                                </div>
                                                <div class="contenido-publicacion-principal-home">
                                                    <h4>{{$article->translation($language)->first() ? $article->translation($language)->first()->title : '-'}}</h4>
                                                    {{--<p>{!!$article->translation($language)->first() ? str_limit($article->translation($language)->first()->image_desc, 50) : '-'!!}</p>--}}
                                                </div>
                                                <div class="mascara-enlace-blog-home">
                                                    <span>@lang('general.read_more') </span>
                                                </div>
                                            </a>
                                        </div>
                                    @else
                                        <div class="col-page col-sm-4 col-md-4">
                                            <a href="{{route('single-article',$article->translation($language)->first()->slug )}}" class="fondo-publicacion-home">
                                            <div class="img-publicacion-home">
                                                <img class="img-responsive" src="{{$article->image->url('original') ? (file_exists($_SERVER['DOCUMENT_ROOT'].$article->image->url('original')) ? $article->image->url('original') : '/assets/img/gallery/1200x900/'.$key++.'.jpg') : '/assets/img/gallery/1200x900/'.$key++.'.jpg'}}">
                                            </div>
                                            <div class="contenido-publicacion-home">
                                                <h4>{{$article->translation($language)->first() ? $article->translation($language)->first()->title : '-'}}</h4>
                                                {{--<p>{!!$article->translation($language)->first() ? str_limit($article->translation($language)->first()->image_desc, 50) : '-'!!}</p>--}}
                                            </div>
                                            <div class="mascara-enlace-blog-home">
                                                <span>@lang('general.read_more')</span>
                                            </div>
                                            </a>
                                        </div>
                                    @endif
                                @endforeach
                                
                            </div>
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
                                                $image = $data->image->url('original') ? (file_exists($_SERVER['DOCUMENT_ROOT'].$data->image->url('original')) ? $data->image->url('original') : '/assets/img/gallery/1200x900/'.$key.'.jpg') : '/assets/img/gallery/1200x900/'.$key.'.jpg';
                                                $title = $data->translation($language)->first() ? $data->translation($language)->first()->title : '-';
                                                $image_desc = $data->translation($language)->first() ? $data->translation($language)->first()->image_desc : '-';
                                            ?>

                                            <div class="list-article">
                                                <div class="col-xs-4 nopadding">
                                                <div class="img-thumb" style="background: url('{{ url($image) }}');background-size: auto auto; "></div>
                                                </div>
                                                <div class="col-xs-8 grey-bg">
                                                <div class="desc-box">
                                                    <a class="article-nav" href="{{ route('single-article',$data->translation($language)->first()->slug )}}">
                                                        <h5>{{ $title }}</h5>
                                                    </a>
                                                    {{--<p>{{ str_limit($image_desc, 50) }}</p>--}}
                                                </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>

                                        <div role="tabpanel" class="tab-pane" id="popular">
                                            @foreach($popular as $key=>$data)
                                            <?php
                                                $image = $data->image->url('original') ? (file_exists($_SERVER['DOCUMENT_ROOT'].$data->image->url('original')) ? $data->image->url('original') : '/assets/img/gallery/1200x900/'.$key.'.jpg') : '/assets/img/gallery/1200x900/'.$key.'.jpg';
                                                $title = $data->translation($language)->first() ? $data->translation($language)->first()->title : '-';
                                                $image_desc = $data->translation($language)->first() ? $data->translation($language)->first()->image_desc : '-';
                                            ?>

                                            <div class="list-article">
                                                <div class="col-xs-4 nopadding">
                                                <div class="img-thumb" style="background: url('{{ url($image) }}');"></div>
                                                </div>

                                                <div class="col-xs-8 grey-bg">
                                                <div class="desc-box">
                                                    <a class="article-nav" href="{{route('single-article',$data->translation($language)->first()->slug )}}">
                                                        <h5>{{ $title }}</h5>
                                                    </a>
                                                    {{--<p>{{  str_limit($image_desc, 50) }}</p>--}}
                                                </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script type="text/javascript">
        window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token()]); ?>;
        function searchArticle(){
            $(".search-form").submit();
        }
    </script>
@endsection