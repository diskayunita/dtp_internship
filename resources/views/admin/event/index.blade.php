@extends('layouts.admin.telkom')
@section('style')
    <link href="{{ URL::asset('assets/css/daterangepicker.min.css') }}" rel='stylesheet' type='text/css'>
    <style type="text/css">
        .remove_field{
            margin-left: 10px;
        }
        
        .ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default {
            border-radius: 0 !important;
            box-shadow: none !important;
            height: auto;
            width: auto;
            cursor: pointer;
        }
        ..ui-widget-content a {
            color: #333333 !important;
        }
        .ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default, .ui-button, html .ui-button.ui-state-disabled:hover, html .ui-button.ui-state-disabled:active {
            border: 1px solid #c5c5c5 !important;
            background: #f6f6f6 !important;
            font-weight: normal !important;
            color: #454545 !important;
        }
        .ui-widget-content {
            border: 1px solid #dddddd !important;
            background: #ffffff !important;
            color: #333333 !important;
        }
        .ui-widget {
            font-family: Arial,Helvetica,sans-serif  !important;
            font-size: 1em  !important;
        }
    </style>
@endsection

@section('content')
    <div class="col-md-12">
        <div class="card">

            <div class="card-header">
                <h4 class="card-title">
                    <i class="ti-calendar"></i>
                    Event List
                </h4>
            </div>
            <div class="card-header">
                <div class='btn-group'>
                    <a href="{{ route('admin.create_event') }}" class='btn btn-primary btn-sm' class='btn btn-info btn-xs' title="Add Event">
                        <i class="fa fa-plus"></i> Add</a>
                </div>
            </div>

            <div class="card-content table-responsive">
                <div class="form-horizontal">
                    <div class="input-fields-wrap">
                        <div class="form-group">
                            <label class="control-label col-sm-2">Select Filter</label>
                            <div class="col-sm-3 input-group">
                                <select id="filter_list" class="form-control add_filter" style="border: 1px solid #e8e7e3;border-radius: 4px;">
                                    <option value="">-- Select Filter --</option>
                                    <option value="periode">Created Date</option>
                                    <option value="approval">Status</option>
                                    <option value="university">University</option>
                                    <option value="type">Period</option>
                                    {{--<option value="location">Lokasi</option>--}}
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- <input type="text" name="daterange" id="periode" value="01/01/2015 - 01/31/2015" /> -->
                    <div class="form-group">
                        <div class="col-sm-5 col-sm-offset-2">
                            <div class='btn-group'>
                                <a href="javascript:void(0);" class='btn btn-primary btn-sm btn-search' disabled title="Export to PDF" onclick="searchReport()">
                                    <i class="fa fa-search"></i> Search
                                </a>
                                <a href="javascript:void(0);" class='btn btn-primary btn-sm btn-export' title="Export to Excel" data-export="excel">
                                    <i class="fa fa-file-excel-o"></i> Excel
                                </a>
                                <a href="javascript:void(0);" class='btn btn-primary btn-sm btn-export' title="Export to PDF" data-export="pdf">
                                    <i class="fa fa-file-pdf-o"></i> Pdf
                                </a>
                            </div>
                            
                        </div>
                    </div>
                    
                </div>

                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>University</th>
                        <th>Status</th>
                        <th>Date Created</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($events as $key => $event)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $event->username }}</td>
                            <td>{{ $event->university }}</td>
                            {{--<td>{{$event->title}}</td>--}}
                            {{--<td>{{$event->description}}</td>--}}
                            <td>
                                @php $status = ucfirst($event->approval) @endphp
                                <span class="{{ statusLabelColor($status) }}">{{ $status }}</span>
                            </td>
                            <td>{{ date("d, M Y",strtotime($event->created_at)) }}</td>
                            <td>
                                
                                <form method="POST" action="{{ route('admin.event.destroy', $event->id) }}" accept-charset="UTF-8">
                                    {{ csrf_field() }}
                                    <input name="_method" type="hidden" value="DELETE">

                                    <a href="{!! route('admin.event.show', [$event->id]) !!}" class='btn btn-info btn-xs' title="detail">
                                        <i class="ti-eye"></i>
                                    </a>
                                    {{--<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#responModal"> 
                                        <i class="fa fa-paper-plane-o"></i>
                                        </button>--}}
                                    {{-- @if($event->approval)
                                        @else
                                            <a href="{!! route('admin.event.approve', [$event->id]) !!}" class='btn btn-primary btn-xs' title="approve"><i class="glyphicon glyphicon-ok-circle"></i></a>
                                        @endif --}}
                                    @if(Auth::user()->hasRole('superadmin') || Auth::user()->hasRole('idex'))
                                        <button type="submit" class="btn btn-danger btn-xs" title="delete" onclick="return confirm('Yakin ingin menghapus admin ini?')">
                                            <i class="ti-trash"></i>
                                        </button>
                                    @endif

                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('assets/js/daterangepicker.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">

        $(document.body).on('change', '#province_id', function () {
            $.get('/api/city/' + this.value + '/province.json', function(cities) {
                var $city = $('#city_id');
                $city.find('option').remove().end();
                $city.append('<option value="">-- Pilih Kota --</option>');
                $.each(cities, function(index, city) {
                    $city.append('<option value="' + city.id  + '">' + city.name + '</option>');
                });
            });
        });

        /*$(document).ready(function() {
            $(".province_id option[value='0']").attr("disabled","disabled");
            $(".city_id option[value='0']").attr("disabled","disabled");
        });*/

        $(document).ready(function () {
            var wrapper = $(".input-fields-wrap"); //Fields wrapper
            $( "select#filter_list" ).on('change', function () {
                var filterValue = $(this).val(); // get the value of selected option
                var filterText = $(this).find(":selected").text(); // get the text label of selected option

                if (filterValue.length <= 0) {
                    return
                }

                if (filterValue == 'approval') {
                    $(wrapper).append('<div class="form-group"><label class="control-label col-sm-2">' + filterText + '</label><div class="col-sm-3 input-group"><select id="' + filterValue + '" name="' + filterValue + '" class="form-control add_filter"><option value="approved">Approved</option><option value="pending" >Pending</option><option value="rejected">Rejected</option><option value="interview">Interview</option><option value="completed">Completed</option></select><div class="input-group-btn"><button class="btn btn-default remove_field" ><i class="fa fa-close"></i></button></div></div></div>');
                }  else if (filterValue == 'university') {
                    $(wrapper).append('<div class="form-group"><label class="control-label col-sm-2">' + filterText + '</label><div class="col-sm-3 input-group"><select id="' + filterValue + '" name="' + filterValue + '" class="form-control add_filter">@foreach($university as $university)<option value="{{ $university->name }}" {{old('university') == $university->name ? 'selected' : ''}}>{{ $university->name }}</option> @endforeach</select><div class="input-group-btn"><button class="btn btn-default remove_field" ><i class="fa fa-close"></i></button></div></div></div>');
                {{--}  else if (filterValue == 'types') {
                    $(wrapper).append('<div class="form-group"><label class="control-label col-sm-2">' + filterText + '</label><div class="col-sm-3 input-group"><select id="' + filterValue + '" name="' + filterValue + '" class="form-control add_filter">@foreach($types as $type)<option value="{{ $type->name }}" {{ select_s(old('type'), $type, $event->type) }}>{{ is_null($type->translation($language)->first()) ? $type->name : $type->translation($language)->first()->name }}</option> @endforeach</select><div class="input-group-btn"><button class="btn btn-default remove_field" ><i class="fa fa-close"></i></button></div></div></div>');--}}
                } else {
                    $(wrapper).append('<div class="form-group"><label class="control-label col-sm-2">' + filterText +'</label><div class="col-sm-3 input-group"><input id="' + filterValue + '" name="' + filterValue + '" class="form-control" type="text" /><div class="input-group-btn"><button class="btn btn-default remove_field" ><i class="fa fa-close"></i></button></div></div></div>');
                }

                // daterangepicker config
                var dateRangePicker = (function() {
                    $('#periode').daterangepicker({
                        locale: { format: 'YYYY-MM-DD' }
                    });

                    $('#date').daterangepicker({
                        locale: { format: 'YYYY-MM-DD' }
                    });
                })();

                $('.btn-search').removeAttr('disabled');
                $('select option[value="'+filterValue+'"]').attr('disabled','disabled');
                $(wrapper).on("click",".remove_field", function(e){ //user click on remove button
                    e.preventDefault();
                    $(this).parent('div').parent('div').parent('div').remove();
                })
            });
        });

        function filterBy ()
        {
            var filterBy = '?';

            if ($('#approval').length > 0 && $('#approval').val() != '') {
                filterBy = filterBy+'&approval='+$('#approval').val();
            }
            if ($('#periode').length > 0 && $('#periode').val() != '') {
                filterBy = filterBy+'&periode='+$('#periode').val();
            }
            if ($('#date').length > 0 && $('#date').val() != '') {
                filterBy = filterBy+'&date='+$('#date').val();
            }
            if ($('#university').length > 0 && $('#university').val() != '') {
                filterBy = filterBy+'&university='+$('#university').val();
            }
            if ($('#type').length > 0 && $('#type').val() != '') {
                filterBy = filterBy+'&type='+$('#type').val();
            }

            return filterBy;
        }

        function searchReport(){
            window.location="{{ route('admin.event.index') }}"+filterBy();
        }

        $('a.btn-export').on('click', function (e) {
            e.preventDefault();
            var request = $(this).data('export');
            var url = window.location.search;
            var filter = url.replace("?", '');

            if (request == 'pdf') {
                window.location="{{ route('admin.event_pdf') }}?"+filter;
            } else if (request == 'excel') {
                window.location = "{{ route('admin.event_excel') }}?" + filter;
            } else {}
        });
    </script>
@endsection