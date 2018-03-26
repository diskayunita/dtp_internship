@if(!$pictures->isEmpty())
    @php
        $count = 1;
        $block = 0;
    @endphp
    @foreach($pictures as $picture)
        @if ($count%4 == 1)
        @php $block++; @endphp
            <div class="cbp-loadMore-block{{$block}}">
        @endif  
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
        @if($count%4 == 0)
            </div>
        @endif
        @php $count++; @endphp
    @endforeach
    @if($count%4 != 1)
        </div>
    @endif
@endif