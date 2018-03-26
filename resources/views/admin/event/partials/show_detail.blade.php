
<div class="col-md-12">
    <h4 class="card-title">
        <i class="ti-user"></i> Person In Charge (P.I.C)
        <hr />
    </h4>

    <div class="form-group">
        <div class="col-md-4">
            <strong>Name</strong>
        </div>
        <div class="col-sm-8">
            <p>: {{ $event->exists ? $event->username : '' }}</p>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-4">
            <strong>Contact</strong>
        </div>
        <div class="col-md-8">
            <p>: {{ $event->exists ? $event->contact : '' }}</p>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-4">
            <strong>Email</strong>
        </div>
        <div class="col-md-8">
            <p>: {{$event->exists ? $event->email : '' }}</p>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-4">
            <strong>University</strong>
        </div>
        <div class="col-md-8">
            <p>: {{ $event->exists ? $event->university : '' }}</p>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-4">
            <strong>Faculty</strong>
        </div>
        <div class="col-md-8">
            <p>: {{ $event->exists ? $event->faculty : '' }}</p>
        </div>
    </div>

    @if($event->approval == 'approved')
        <div class="form-group">
            <div class="col-md-4">
                <strong>Url Survey</strong>
            </div>
            <div class="col-md-8">:
            @if($hasSurvey)
                    <p><a target="_blank" href="{{ $refUrl }}">{{ $refUrl }}</a></p>
                @else
                    <p><b>Survey has not been created.</b></p>
                @endif
            </div>
        </div>
    @endif

</div>

<div class="col-md-12">

    <h4 class="card-title">
        <i class="ti-user"></i> Event / Agency Detail
        <hr />
    </h4>

    <div class="form-group">
        <div class="col-md-4">
            <strong>Event Purpose</strong>
        </div>
        <div class="col-md-8">
            <p>: {{$event->exists ? $event->type : '' }}</p>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-4">
            <strong>Remaining Credits</strong>
        </div>
        <div class="col-md-8">
            <p>: {{$event->exists ? $event->credits : '' }}</p>
        </div>
    </div>



    <div class="form-group">
        <div class="col-md-4">
            <strong>University</strong>
        </div>
        <div class="col-md-8">
            <p>: {{$event->exists ? $event->university : '' }}</p>
        </div>
    </div>


    <div class="form-group">
        <div class="col-md-4">
            <strong>Location</strong>
        </div>
        <div class="col-md-8">:
        @foreach($purposes as $purpose)
                <span class="label label-dds">{{ $purpose->translation('en')->first()->name }}</span>&nbsp;
            @endforeach
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-4">
            <strong>Attachment</strong>
        </div>
        <div class="col-md-8">
            <p>:
            @if(isset($event->attachment) && $event->exists && file_exists($_SERVER['DOCUMENT_ROOT'].$event->attachment->url()))
                <a href="{{ $event->attachment->url() }}" target="_blank">Open</a>
            @else
                <b>CV isn't attached</b>
            @endif
            </p>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-4">
            <strong>Integrity Pact</strong>
        </div>
        <div class="col-md-8">
            <p>:
            @if(isset($event->pakta) && $event->exists && file_exists($_SERVER['DOCUMENT_ROOT'].$event->pakta->url()))
                <a href="{{ $event->pakta->url() }}" target="_blank">Open</a>
            @else
                <b>integrity pact isn't attached</b>
            @endif
            </p>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-4">
            <strong>Note</strong>
        </div>
        <div class="col-md-8">
            <p>: {{ $event->exists ? $event->description : '' }}</p>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-4">
            <strong>Status</strong>
        </div>
        <div class="col-md-8">
            @php $status = (!empty($event->approval)) ? $event->approval : 'pending'; @endphp
            : <span class="{{ statusLabelColor($status) }}">{{ $status }}</span>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-4" style="margin: 10px 0px">
            <strong>Job</strong>
        </div>
        <div class="col-md-8" style="margin: 10px 0px">:
        @foreach($product as $product)
                <span class="label label-success">{{ $product->translation('en')->first()->name }}</span>&nbsp;
            @endforeach
        </div>
    </div>
</div>
