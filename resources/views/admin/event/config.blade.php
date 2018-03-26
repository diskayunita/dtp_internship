@extends('layouts.admin.telkom')

@section('content')
    <div class="col-md-12">
        <form method="post" role="form" action="{{route('admin.event_config_store')}}" class="form-horizontal">
            {{ csrf_field() }}
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        <i class="ti-plus"></i> Event Config
                    </h4>
                    <p class="category">Changable rules create event</p>
                </div>


                {{-- card-content --}}
                <div class="card-content">
                    <fieldset>
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} column-sizing">
                            <label class="col-sm-2 control-label">Limit of Participans</label>
                            <div class="col-sm-10">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input placeholder="Minimal" name="minparticipant" value="{!! isset($config) ? $config->minparticipant : '' !!}" class="form-control" type="number" required/>
                                    </div>
                                    <div class="col-md-4">
                                        <input placeholder="Maksimal" name="maxparticipant" value="{!! isset($config) ? $config->maxparticipant : '' !!}" class="form-control" type="number" required/>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Minimum date</label>
                            <div class="col-sm-10">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input placeholder="Minimum Hari H" name="minimumdate" value="{!! isset($config) ? $config->minimumdate : '' !!}" class="form-control border-input" type="number" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
                {{-- card-content --}}

                <div class="card-footer">
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary btn-fill btn-wd">
                            <i class="ti-check"></i> Save
                        </button>
                    </div>
                </div>{{-- /.card-footer --}}

            </div>  <!-- end card -->
        </form>
    </div>
@endsection
