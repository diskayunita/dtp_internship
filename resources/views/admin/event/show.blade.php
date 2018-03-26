@extends('layouts.admin.telkom')
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
@section('content')
    <div class="col-md-12">
        <div class="card">

            <div class="card-header">
                <h4 class="card-title">
                    <i class="ti-calendar"></i>
                    Event Details
                </h4>
                <p class="category">View Event Details</p>
            </div>{{-- card-header --}}

            <div class="card-content">
                <div class="row">

                    {{-- Event-Detail --}}
                    @include('admin.event.partials.show_detail')

                    {{-- response-modal --}}
                    @include('admin.event.partials.response_modal')

                </div>
            </div>{{-- card-content --}}

            <div class="card-footer text-center">
                <a href="{!! route('admin.event.index') !!}" class="btn btn-default btn-fill btn-wd btn-move-left">
                    <i class="ti-angle-left"></i>
                    Cancel
                </a>
                {{-- Modal Trigger --}}
                <button type="button" class="btn btn-primary btn-fill" data-toggle="modal" data-target="#responModal">
                    <i class="fa fa-paper-plane-o"></i>
                    Give response
                </button>
            </div>

        </div>{{-- Card End --}}

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <i class="ti-email"></i>
                    Response History
                </h4>
                <p class="category">Response that has been sent</p>
            </div>{{--card-header--}}

            <div class="card-content table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Response Status</th>
                            <th>Message</th>
                            <th>Approved Staff</th>
                            <th>Replied at</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($event->responses as $key => $response)
                        <tr>
                            <td><span class="{{ statusLabelColor($response->response_type) }}">{{ $response->response_type }}</span></td>
                            <td><?php echo html_entity_decode($response->message, ENT_QUOTES, "utf-8"); ?></td>
                            <td>{{ (!empty($response->staff)) ? $response->staff->name : '' }}</td>
                            <td>{{ date("d, M Y | H:i",strtotime($response->created_at)) }}</td>
                            {{-- <td>{{ $response->created_at }}</td> --}}
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>{{--card-content--}}
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        function enableEditor(obj){
             if (obj.value=='approved'){
             $('.removable').children().remove();
             $('.removable').append('<div class="form-group"><label for="message">Date :</label><input id="date" type="date" value="{{ valdate( old('date'), $event->date ) }}" class="form-control date-picker" name="date" data-field="date" data-format="YYYY-mm-dd" required ></div>');
                $('.removable').append('<div class="form-group"><label for="message">Time :</label><input id="time" type="time" value="{{ valdate( old('time'), $event->time ) }}" class="form-control timestamps " name="time" data-field="time" data-format="hh:mm" required ></div>');
                $('.removable').append('<div class="form-group"><label for="message">Location :</label><input id="location" type="text" value="{{ old('location'), $event->location  }}" class="form-control border-input " name="location" data-field="text" required ></div>');
                $('.removable').append('<div class="form-group"><label for="message">Message :</label><textarea  class="form-control border-input" id="message" name="message" value="{{ $event->message }}" required>@lang('contact.inquiry.messageapprove')</textarea></div>');

                if (!CKEDITOR.instances.message){
                   CKEDITOR.instances( 'message', {
                        filebrowserBrowseUrl : '/elfinder/ckeditor',
                        filebrowserImageBrowseUrl : '/elfinder/ckeditor',
                        filebrowserUploadUrl : "{{route('upload_elfinder',['_token' => csrf_token() ])}}",
                    });
                    
                }
                
            }else if(obj.value=='interview'){
                $('.removable').children().remove();
                $('.removable').append('<div class="form-group"><label for="message">Date :</label><input id="date" type="date" value="{{ valdate( old('date'), $event->date ) }}" class="form-control date-picker" name="date" data-field="date" data-format="YYYY-mm-dd" required ></div>');
                $('.removable').append('<div class="form-group"><label for="message">Time :</label><input id="time" type="time" value="{{ valdate( old('time'), $event->time ) }}" class="form-control timestamps " name="time" data-field="time" data-format="hh:mm" required ></div>');
                $('.removable').append('<div class="form-group"><label for="message">Location :</label><input id="location" type="text" value="{{ old('location'), $event->location  }}" class="form-control border-input " name="location" data-field="text" required ></div>');
                $('.removable').append('<div class="form-group"><label for="message">Message :</label><textarea  class="form-control border-input" id="message" name="message" value="{{ $event->message }}" required>@lang('contact.inquiry.messageinterview')</textarea></div>');
                if (CKEDITOR.instances.message){
                   CKEDITOR.instances.message.destroy(); 
                }

            }else if(obj.value=='rejected'){
                $('.removable').children().remove();
                $('.removable').append('<div class="form-group"><label for="message">Message :</label><textarea  class="form-control border-input" id="message" name="message" value="{{ $event->message }}" required>@lang('contact.inquiry.messagereject')</textarea></div>');
                if (CKEDITOR.instances.message){
                   CKEDITOR.instances.message.destroy(); 
                }
                
            }else{
               $('.removable').children().remove();
               $('.removable').append('<div class="form-group"><label for="message">Message :</label><textarea  class="form-control border-input" id="message" name="message" value="{{ $event->message }}" required>@lang('contact.inquiry.messagecomplete')</textarea></div>');
                if (CKEDITOR.instances.message){
                   CKEDITOR.instances.message.destroy(); 
                }
            }
        }
    </script>
@endsection