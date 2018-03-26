@extends('layouts.admin.telkom')

@section('content')
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Detail Article</h4>
        <ul class="nav nav-tabs" id="myTab">
          <li class="active">
            <a href="#id">Indonesia</a>
          </li>
          <li>
            <a href="#en">English</a>
          </li>
        </ul>
      </div>

      <div class="card-content">
        <form class="form-horizontal" style="margin-top: 10px;" method="POST" action="javascript:void(0)" enctype="multipart/form-data">
          <div class="tab-content">
            @include('admin.about.show-field')
            <div class="form-group">
              <div class="col-md-10 col-md-offset-2">
                <a href="{{route('admin.about.index')}}" class="btn btn-primary" type="reset">Back</a>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection