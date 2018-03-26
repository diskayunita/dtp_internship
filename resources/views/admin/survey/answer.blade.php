@extends('layouts.admin.telkom')

@section('content')

    <style>
        .dataTables tbody tr {
            min-height: 35px; /* or whatever height you need to make them all consistent */
        }
        .fixedTable {
            table-layout: fixed;
            width: 100%;
        }
        .fixedTable > tbody > tr > td {
            overflow: scroll;
            overflow-y: hidden;
            overflow-x: auto;
            z-index: 2;
        }
        p.title {
            word-break: break-all;
            font-weight: bold;
        }
        p.breakContent {
            word-break: break-all;
        }
        a.canvasjs-chart-credit {display:none;}
    </style>
    <div class="col-md-12">
        <div class="card">

            <div class="card-header">
                <h4 class="card-title">
                    <i class="ti-calendar"></i>
                    Answer List
                </h4>
            </div>
            <div class="card-header">
                <div class='btn-group'>
                    <a href="{{ route('admin.answer_excel',$survey->id) }}" class='btn btn-primary btn-sm' class='btn btn-info btn-xs' title="Export to Excel">
                        <i class="fa fa-file-excel-o"></i> Excel</a>
                    <a href="{{ route('admin.answer_pdf',$survey->id) }}" class='btn btn-primary btn-sm' class='btn btn-info btn-xs' title="Export to PDF">
                        <i class="fa fa-file-pdf-o"></i> Pdf</a>
                </div>
            </div>

            <div class="card-content table-responsive">
                <table class="table table-hover text-left fixedTable">
                    <thead>
                    <tr>
                        <th><h5>{{ $survey->title }}</h5></th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($question_list as $qKey => $question)
                        <tr>
                            <td>
                                <h4 class="title">{{ $question['title'] }}</h4>
                                @if($question['type'] == 'checkbox' || $question['type'] == 'radio')
                                    <div id="chartContainer-{{ $qKey }}" style="height: 360px; width: 100%;"></div>
                                    @section('script')
                                        @parent
                                        <script type="text/javascript">
                                            var chart = new CanvasJS.Chart("chartContainer-{{ $qKey }}", {
                                                title:{text: "{{$question['respondent']. ' Respondent'}}"},
                                                animationEnabled: true,
                                                dockInsidePlotArea: true,
                                                verticalAlign: "center",
                                                legend:{
                                                    verticalAlign: "top",
                                                    horizontalAlign: "center",
                                                },
                                                colorSet: 'greenShades',
                                                data: [
                                                    {
                                                        type: "pie",
                                                        showInLegend: true,
                                                        dataPoints: {!! json_encode($question['answer']) !!}
                                                    }
                                                ]
                                            });
                                            chart.render();
                                        </script>
                                    @endsection
                                @else
                                    {!! $question['answer'] !!}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
