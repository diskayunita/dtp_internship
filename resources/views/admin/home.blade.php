@extends('layouts.admin.telkom')
@php
    $title = "Home Page";
@endphp
@section('style')
<style type="text/css">
    .card .content {
        padding: 15px 15px 10px 15px;
    }

    .card .header {
        padding: 20px 20px 0;
    }
</style>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-xs-5">
                            <div class="icon-big icon-warning text-center">
                                <i class="ti-user"></i>
                            </div>
                        </div>
                        <div class="col-xs-7">
                            <div class="numbers">
                                <p>Users</p>
                                {{ $info_box['user']}}
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <hr>
                        <a href="{{route('admin.non-admin.index')}}">
                            <div class="stats">
                                <i class="ti-arrow-right"></i> See
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-xs-5">
                            <div class="icon-big icon-success text-center">
                                <i class="ti-image"></i>
                            </div>
                        </div>
                        <div class="col-xs-7">
                            <div class="numbers">
                                <p>Gallery</p>
                                {{ $info_box['gallery']}}
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <hr>
                        <a href="{{route('admin.gallery.index')}}">
                            <div class="stats">
                                <i class="ti-arrow-right"></i> See
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-xs-5">
                            <div class="icon-big icon-danger text-center">
                                <i class="ti-bookmark"></i>
                            </div>
                        </div>
                        <div class="col-xs-7">
                            <div class="numbers">
                                <p>Articles</p>
                                {{ $info_box['article']}}
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <hr>
                        <a href="{{route('admin.article.index')}}">
                            <div class="stats">
                                <i class="ti-arrow-right"></i> See
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-xs-5">
                            <div class="icon-big icon-info text-center">
                                <i class="ti-calendar"></i>
                            </div>
                        </div>
                        <div class="col-xs-7">
                            <div class="numbers">
                                <p>Events</p>
                                {{ $info_box['events']}}
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <hr>
                        <a href="{{route('admin.event.index')}}">
                            <div class="stats">
                                <i class="ti-arrow-right"></i> series
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="header">
                    <h4 class="title">Event Statistics</h4>
                    <p class="category">The are {{ $event['total'] }} event records in total</p>
                </div>
                <div class="content">
                    <canvas id="eventChart" width="400" height="400"></canvas>
                    <div class="footer">
                        <hr>
                        <div class="stats">
                            <i class="ti-check"></i> All time event record
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card ">
                <div class="header">
                    <h4 class="title">User Registered</h4>
                    <p class="category">The are {{ $user['total'] }} registered user in total</p>
                </div>
                <div class="content">
                    <canvas id="userChart"></canvas>
                    <div class="footer">
                        <div class="chart-legend">
                        </div>
                        <hr>
                        <div class="stats">
                            <i class="ti-check"></i> All time user record
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection
@section('script')
<script type="text/javascript">
    var userChart = document.getElementById('userChart');
    new Chart(userChart, {
        type: 'line',
        data: {
            labels: <?=json_encode($user['label']);?>,
            datasets: [{
                label: "Registered User Performance",
                data: <?=$user['count']?>,
                backgroundColor: ['rgba(54, 162, 235, 1)'],
                borderColor: ['rgba(54, 162, 235, 1)'],
                borderWidth: 1,
                fill: false,
            }]
        },
        options: {
            responsive: true,
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        //get the concerned dataset
                        var dataset = data.datasets[tooltipItem.datasetIndex];
                        var labels = data.labels;
                        //calculate the total of this data set
                       /* var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
                            return previousValue + currentValue;
                        });*/
                        var total = <?=$user['total']?>;
                        //get the current items value
                        var currentValue = dataset.data[tooltipItem.index];
                        var currentLabel = labels[tooltipItem.index].charAt(0).toUpperCase() + labels[tooltipItem.index].slice(1);
                        //calculate the precentage based on the total and current item, also this does a rough rounding to give a whole number
                        var precentage = Math.floor(((currentValue/total) * 100)+0.5);

                        return currentLabel + ' (' + currentValue + ') ' + precentage + "%";
                    }
                }
            },
            scales: {
                xAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Month'
                    }
                }],
                yAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Value'
                    }
                }]
            }
        }
    });
</script>

<script type="text/javascript">
    var eventChart = document.getElementById('eventChart');
    new Chart(eventChart, {
        type: 'pie',
        data: {
            labels: <?=json_encode($event['label']);?>,
            datasets: [{
                data: <?=$event['count']?>,
                backgroundColor: [

                    'rgba(54, 162, 235, 1)', // blue
                    'rgba(75, 192, 192, 1)', // green
                    'rgba(255, 206, 86, 1)', // yellow
                    'rgba(255, 99, 132, 1)', // red
                    'rgba(153, 102, 255, 1)',
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        //get the concerned dataset
                        var dataset = data.datasets[tooltipItem.datasetIndex];
                        var labels = data.labels;
                        //calculate the total of this data set
                        /*var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
                            return previousValue + currentValue;
                        });*/
                        var total = <?=$event['total']?>;
                        //get the current items value
                        var currentValue = dataset.data[tooltipItem.index];
                        var currentLabel = labels[tooltipItem.index].charAt(0).toUpperCase() + labels[tooltipItem.index].slice(1);
                        //calculate the precentage based on the total and current item, also this does a rough rounding to give a whole number
                        var precentage = Math.floor(((currentValue/total) * 100)+0.5);
                        return currentLabel + ' (' + currentValue + ') ' + precentage + "%";
                    }
                }
            }
        }
    });
</script>
@endsection