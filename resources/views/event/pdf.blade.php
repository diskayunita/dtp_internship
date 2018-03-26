<!DOCTYPE html>
<html>
<head>
    <title>Interview Approval</title>
    <style type="text/css">
        table {
            border-collapse: collapse;
            page-break-inside: auto;
        }
        .tb-border th,
        .tb-border td{
            border:1px solid #000;
        }
    </style>
</head>
<body>
<div align="right">
    <img src="{{ asset('img/Telkom-logo.png') }}">
</div>
<table style="border: none">
        <td align="left">{{ date_format($event->responses[0]->created_at,'d F Y')}}</td>
      </tr>
</table>
<br>

<table style="border: none">
    <tr>
        <td align="left" style="padding-right: 15px"><strong>@lang('event/event-create.name') </strong></td>
        <td align="left">: {{ $event->username }}</td>
    </tr>
    <tr>
        <td align="left" style="padding-right: 15px"><strong>@lang('event/event-create.contact') </strong></td>
        <td align="left">: {{ $event->contact }}</td>
    </tr>
    <tr>
        <td align="left" style="padding-right: 15px"><strong>Email</strong> </td>
        <td align="left">: {{ $event->email }}</td>
    </tr>
    <tr>
        <td align="left" style="padding-right: 15px"><strong>University</strong></td>
        <td align="left">: {{ $event->university }}</td>
    </tr>
    <tr>
        <td align="left" style="padding-right: 15px"><strong>Faculty</strong></td>
        <td align="left">: {{ $event->faculty }}</td>
    </tr>
</table>
<br>

<hr>
<h3> Internship Telkom </h3>
<br>
<table style="border: none">
    <tr>
        <td><strong>@lang('event/event-create.purpose')</strong></td>
        <td>: {{$event->exists ? $event->type : '' }}</td>
    </tr>
    <tr>
        <td><strong>@lang('event/event-create.credits')</strong></td>
        <td>: {{$event->exists ? isset($event->credits) ? $event->credits : 'N/A' : '' }}</td>
    </tr>

    <tr>
        <td>
            <strong>
                @lang('event/event-table.Status')
            </strong>
        </td>
        <td>:
            @php
                $status = (!empty($event->approval)) ? $event->approval : 'error';
            @endphp
            <span class="{{ statusLabelColor($status) }}">{{ $status }}</span>
        </td>
    </tr>
</table>

<h5>Response Message</h5>
<p>
    @php $eventResponse = array_values(array_slice($event->responses->toArray(), -1))[0]; @endphp
    {!! html_entity_decode($eventResponse['message'], ENT_QUOTES, "utf-8") !!}
</p>
</tr>
</body>
</html>
