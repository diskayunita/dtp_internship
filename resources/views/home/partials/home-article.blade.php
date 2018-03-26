<section class="content">
    @php $count = 1; @endphp
    @foreach($articles as $key => $article)
        {!! ($count%3 == 1) ? '<div class="row">' : '' !!}

        <div class="col-md-4">
            <div class="box-card">
                <?php
                    $image = $article->image->url() ? (file_exists($_SERVER['DOCUMENT_ROOT'].$article->image->url()) ? $article->image->url('original') : '/assets/img/gallery/1200x900/'.$key.'.jpg') : '/assets/img/gallery/1200x900/'.$key.'.jpg';
                    $title = $article->translation($language)->first() ? $article->translation($language)->first()->title : '-';
                    $description = $article->translation($language)->first() ? $article->translation($language)->first()->image_desc : '-';
                ?>

                <div class="img-card" style="background: url('{{ url($image) }}');"></div>
                <div class="caption-box text-center">
                    <h4 class="article-title">{{ str_limit($title, 50) }}</h4>
                    <p class="article-homepage">{{ str_limit($description, 50) }}</p>
                </div>

                <div class="text-center" align="middle">
                    <a href="{{ route('single-article',$article->translation($language)->first()->slug ) }}" class="btn btn-md btn-read-more-round btn-grey">@lang('general.read_more')</a>
                </div>
            </div>
        </div>

        {!! ($count%3 == 0) ? '</div>' : '' !!}
        @php $count++; @endphp
    @endforeach
    {!! ($count%3 != 1) ? '</div>' : '' !!}
</section>