<section class="content">
    <div class="row">
        <div class="col-md-8">
            {{--<div class="box-calendar bg-grey">
                <div class="list-article-big">
                  {!! //$calendar->generate() !!}
                </div>
            </div>--}}

            <div class="box-calendar">

                <div class="row">
                    @php
                        switch (count($events)):
                            case 1:
                                $style = 'col-md-4 col-md-offset-4';
                                break;
                            case 2:
                                $style = 'col-md-4 col-md-offset-2';
                                break;
                            default:
                                $style = 'col-md-4';
                        endswitch;
                    @endphp
                    @foreach($events as $start_date => $event)
                        <div class="{{ $style }}">
                            <div class="panel panel-default calendar-panel">
                                <div class="panel-body calendar-block">
                                    @php $start_date = new \Carbon\Carbon($start_date) @endphp
                                    <span class="date">{{ $start_date->format('d') }}</span>
                                    <br />
                                    <span class="month">{{ $start_date->format('M') }}</span>

                                    @foreach($event as $eKey => $eValue)
                                        @php
                                            $label_style = ($eValue['session'] == 'sesi 1') ? 'session1' : 'session2';
                                        @endphp
                                        <div class="event-box {{ $label_style }}">
                                            <div class="event-agency">
                                                <span class="badge badge-white badge-roundless" style="margin-bottom: 5px;">{{ $eValue['agency_type'] }}</span>
                                                <span class="badge badge-white badge-roundless" style="margin-bottom: 5px;">{{ $eValue['session'] }}</span><br>
                                                <span style="background-color: #f39c12; padding: 2px;" title="{{ $eValue['agency_name'] }}">{{ str_limit($eValue['agency_name'], 20) }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>

            <div class="box-news">
                <div class="list-article-big">
                    <div id="carousel-article" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        {{--<ol class="carousel-indicators">
                            @foreach($page_article as $key=>$data)
                                <li data-target="#carousel-article" data-slide-to="$key" class="{{ $key==0 ? 'active' : ''}}"></li>
                            @endforeach
                        </ol>--}}

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            @foreach($page_article as $key=>$article)
                                <div class="item{{ $key==0 ? ' active' : ''}}">
                                    <?php
                                        $image = $article->image->url() ? (file_exists($_SERVER['DOCUMENT_ROOT'].$article->image->url()) ? $article->image->url('original') : '/assets/img/gallery/1200x900/'.$key.'.jpg') : '/assets/img/gallery/1200x900/'.$key.'.jpg';
                                        $title = $article->translation($language)->first() ? $article->translation($language)->first()->title : '-';
                                        $description = $article->translation($language)->first() ? $article->translation($language)->first()->content : '-';
                                    ?>

                                    <div class="col-md-5 nopadding">
                                        <div class="img-thumb-big" style="background: url('{{ url($image) }}');"></div>
                                    </div>

                                        <div class="col-md-7 grey-bg-big">
                                            <div class="desc-box-title">
                                                {{ str_limit($title, 50) }}
                                            </div>

                                            <div class="desc-box desc-paragraph">
                                                <p><?php echo html_entity_decode(str_limit($description,600), ENT_QUOTES, "utf-8"); ?></p>
                                                <a href="{{ route('single-article',$article->translation($language)->first()->slug ) }}" class="btn btn-red btn-read-more-square">@lang('general.read_more')</a>
                                            </div>
                                        </div>
                                </div>
                            @endforeach
                        </div>
                        <a class="left carousel-control" href="#carousel-article" role="button" data-slide="prev" style="border-bottom:none">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#carousel-article" role="button" data-slide="next" style="border-bottom:none">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
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
</section>