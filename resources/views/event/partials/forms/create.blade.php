<form class="form-horizontal" role="form" method="POST" action="{{ route('event.store') }}" enctype="multipart/form-data" >
    {{ csrf_field() }}

    {{-- field pic --}}
    <div class="col-md-6">
        @include('event.partials.fields.pic')
    </div>{{-- col-md-6 --}}

    {{-- field event --}}
    <div class="col-md-6">
        @include('event.partials.fields.event')
    </div>{{-- col-md-6 --}}

    {{-- Button --}}
    <div class="col-md-12 text-center">
        <div class="btn-group">
            <a href="{{ route('event.index') }}" class="btn btn-md btn-red">
                <i class="fa fa-caret-left"></i>
                @lang('event/event-create.back')
            </a>
        </div>
        <div class="btn-group">
            <button type="submit" class="btn btn-md btn-red">
                <i class="fa fa-paper-plane-o"></i>
                @lang('event/event-create.submit')
            </button>
        </div>
    </div>
</form>
