@extends('layouts.admin.telkom')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><i class="ti-email"></i> Message</h4>
                <p class="category"></p>
            </div>

            <div class="card-content table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Subject</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Read</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($messages as $message)
                        <tr>
                            <td>{{$message->subject}}</td>
                            <td>{{$message->name}}</td>
                            <td>{{$message->email}}</td>
                            <td>
                                @if($message->read)
                                    <span class="label label-primary"><i class="fa fa-envelope-open"></i> Yes</span>
                                @else
                                    <span class="label label-danger"><i class="fa fa-envelope"></i> No</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('admin.message.edit', [$message->id])}}" class='btn btn-primary btn-xs' title="open messeage">
                                    <i class="glyphicon glyphicon-envelope"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection