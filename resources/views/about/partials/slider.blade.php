    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            @foreach($sliders as $key => $data)
            <li data-target="#carousel-example-generic" data-slide-to="$key" class="{{ $key == 0 ? 'active' : ''}}"></li>
            @endforeach
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            @foreach($sliders as $key=>$slider)
            <div class="item{{ $key==0 ? ' active' : ''}}">
                <img src="{{ $slider->image->url('slider') ? (file_exists($_SERVER['DOCUMENT_ROOT'].$slider->image->url('slider')) ? $slider->image->url('slider') : '/assets/img/gallery/1200x900/'.$key.'.jpg') : '/assets/img/gallery/1200x900/'.$key.'.jpg'}}" alt="{{$slider->translation($language)->first() ? $slider->translation($language)->first()->caption : '-' }}" alt="slider-image">
            </div>
            @endforeach
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>