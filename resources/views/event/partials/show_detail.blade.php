<div class="col-md-6">
    <h4><i class="fa fa-user"></i> @lang('event/event-create.person')</h4>
    <hr>

    {{-- Name --}}
    <div class="form-group">
        <div class="col-md-4">
            <strong>@lang('event/event-create.name') : </strong>
        </div>
        <div class="col-md-8">
            {{ $event->exists ? $event->username : '' }}
        </div>
    </div>

    {{-- Contact --}}
    <div class="form-group">
        <div class="col-md-4">
            <strong>@lang('event/event-create.contact') : </strong>
        </div>
        <div class="col-md-8">
            {{ $event->exists ? $event->contact : '' }}
        </div>
    </div>

    {{-- Email --}}
    <div class="form-group">
        <div class="col-md-4">
            <strong>Email : </strong></div>
        <div class="col-md-8">
            {{$event->exists ? $event->email : '' }}
        </div>
    </div>

   {{-- university --}}
    <div class="form-group">
        <div class="col-md-4">
            <strong>University : </strong></div>
        <div class="col-md-8">
            {{$event->exists ? $event->university : '' }}
        </div>
    </div>

    {{-- Faculty --}}
    <div class="form-group">
        <div class="col-md-4">
            <strong>Faculty : </strong></div>
        <div class="col-md-8">
            {{$event->exists ? $event->faculty : '' }}
        </div>
    </div>

</div>

<div class="col-md-6">
    <h4><i class="fa fa-calendar"></i> @lang('event/event-create.detail')</h4>
    <hr>

    {{-- Judul Kunjungan / Event Purpose --}}
    <div class="form-group">
        <div class="col-md-4">
            <strong>@lang('event/event-create.purpose') : </strong>
        </div>
        <div class="col-md-8">
            {{$event->exists ? $event->type : '' }}
        </div>
    </div>

    {{-- Sisa SKS --}}
    <div class="form-group">
        <div class="col-md-4">
            <strong>@lang('event/event-create.credits') : </strong>
        </div>
        <div class="col-md-8">
            {{$event->exists ? isset($event->credits) ? $event->credits : 'N/A' : '' }}
        </div>
    </div>


    {{-- Tujuan / Destination --}}
    <div class="form-group">
        <div class="col-md-4">
            <strong>@lang('event/event-create.destination') :</strong>
        </div>
        <div class="col-md-8">
            @foreach($purposes as $purpose)
                <span class="label label-dds">{{ $purpose->translation($language)->first()->name }}</span>&nbsp;
            @endforeach
        </div>
    </div>

    {{-- Attachment --}}
    <div class="form-group">
        <div class="col-md-4">
            <strong>Attachment :</strong>
        </div>
        <div class="col-md-8">
            <p>
                @if(isset($event->attachment))
                    <a href="{{ $event->exists ? $event->attachment->url() : '' }}" target="_blank">Open</a>
                @else
                    <b>attachment isn't attached</b>
                @endif
            </p>
        </div>
    </div>

    {{-- Catatan / Description --}}
    <div class="form-group">
        <div class="col-md-4">
            <strong>@lang('event/event-create.note') :</strong>
        </div>
        <div class="col-md-8">
            {{ $event->exists ? $event->description : '' }}
        </div>
    </div>

    {{-- Status --}}
    <div class="form-group">
        <div class="col-md-4">
            <strong>@lang('event/event-table.Status') :</strong>
        </div>
        <div class="col-md-8">
            @php
                $status = (!empty($event->approval)) ? $event->approval : 'error';
            @endphp
            <span class="{{ statusLabelColor($status) }}">{{ $status }}</span>
        </div>
    </div>
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
        <a href="{{ route('event.edit', $event->id) }}" class="btn btn-md btn-blue">
            <i class="fa fa-paper-plane-o"></i>
            Revisi
        </a>
    </div>
</div>
