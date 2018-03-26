@extends('layouts.main.telkom')
@section('title')
  <title>Telkom DDS | Gallery</title>
@endsection
@section('content')
    <div class="page-content">
        <div class="container">
            <div class="page-content-inner">
                <div class="blog-page blog-content-2">
                    <div class="row">
                        <div class="portfolio-content portfolio-1">
                            <div class="cbp-l-filters-button">
                                @if(!empty($categories) && !empty($yearspics))
                                    <div id="js-filters-juicy-projects" class="pull-left">
                                        <div data-filter="*" class="cbp-filter-item-active cbp-filter-item btn dark btn-outline uppercase">
                                            @lang('gallery.all')
                                            <div class="cbp-filter-counter"></div>
                                        </div>
                                        @foreach($categories as $category)
                                            @if (!empty(current($category->galleries)))
                                                <div data-filter=".{{$category->name}}"
                                                    class="cbp-filter-item btn dark btn-outline uppercase">
                                                    {{!is_null($category->has('translation')->first()) ? ($category->translation($language)->first() ? $category->translation($language)->first()->name : $category->name) : $category->name}}
                                                    <div class="cbp-filter-counter"></div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                                
                                <div id="filter-year" class="pull-right">
                                    @if(!empty($yearspics))
                                        <div data-filter="*" class="cbp-filter-item-active cbp-filter-item btn dark btn-outline uppercase">
                                            @lang('gallery.all')
                                            <div class="cbp-filter-counter"></div>
                                        </div>
                                        
                                        @foreach($yearspics as $no=>$year)
                                            <div data-filter=".{{$year}}"
                                                class="cbp-filter-item btn dark btn-outline uppercase">
                                                {{$year}}
                                                <div class="cbp-filter-counter"></div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            
                            @if (!empty($pictures))
                                <div id="js-grid-juicy-projects" class="cbp">
                                    @foreach($pictures as $key=>$picture)
                                        <div class="cbp-item {{$picture->category ? $picture->category->name : ''}} {{$picture->created_at->year}}">
                                            <div class="cbp-caption">
                                                <div class="cbp-caption-defaultWrap">
                                                    <img src="{{$picture->image->url('notzoom') ? (file_exists($_SERVER['DOCUMENT_ROOT'].$picture->image->url('notzoom')) ? $picture->image->url('notzoom') : '/assets/img/gallery/1200x900/'.$key.'.jpg') : '/assets/img/gallery/1200x900/'.$key.'.jpg'}}" alt="">
                                                </div>
                                                <div class="cbp-caption-activeWrap">
                                                    <div class="cbp-l-caption-alignCenter">
                                                        <div class="cbp-l-caption-body">
                                                            <a href="{{ route('gallery_detail',$picture->id) }}"
                                                                class="cbp-singlePage cbp-l-caption-buttonLeft btn red uppercase btn red uppercase" rel="nofollow">detail</a>

                                                            <a href="{{$picture->image->url() ? $picture->image->url('zoomed') : '-'}}"
                                                                class="cbp-lightbox cbp-l-caption-buttonRight btn red uppercase btn red uppercase" data-title="Dashboard<br>by Kave.in">perbesar</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            {{-- @if ($pictures->count() > 9) --}}
                                <div id="js-loadMore-juicy-projects" class="cbp-l-loadMore-button">
                                    <a href="gallery/loadmore/{{$picture->id}}" class="cbp-l-loadMore-link btn grey-mint btn-outline"
                                    rel="nofollow">
                                        <span class="cbp-l-loadMore-defaultText">LOAD MORE</span>
                                        <span class="cbp-l-loadMore-loadingText">LOADING...</span>
                                        <span class="cbp-l-loadMore-noMoreLoading">NO MORE ITEMS</span>
                                    </a>
                                </div>
                            {{-- @endif --}}
                        </div>
                        
                        <div class="clearfix"></div>
                        <br />
                    </div>
                </div>
            </div>
        </div>
    </div>
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
    </script>

    <script>
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