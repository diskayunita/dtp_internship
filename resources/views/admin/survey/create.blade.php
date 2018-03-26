@extends('layouts.admin.telkom')

@section('content')
  <div class="col-md-8 col-md-offset-2">
      <div class="card">
          <div class="card-header">
              <h4 class="card-title">
                  <i class="ti-plus"></i>
                  Create Survey
              </h4>
              <p class="category">Fill the form below to create new survey</p>
          </div>
          <div class="card-content">
              <form method="POST" action="{{route('admin.survey.store')}}" id="boolean">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  @include('admin.survey.partials.form_fields')
              </form>
          </div>
      </div>  <!-- end card -->
  </div>
@endsection