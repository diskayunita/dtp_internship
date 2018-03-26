@extends('layouts.main.telkom')

@section('content')
<div class="page-head">
  <div class="container">
    <div class="page-title">

    </div>
  </div>
</div>
<div class="page-content">
  @include('flash::message')
  <div class="container" style="margin-top: 30px;">
    <div class="profile-head">
      <div class="col-md- col-sm-4 col-xs-12">
        <img src="{{$user->avatar->url('medium') ? (file_exists($_SERVER['DOCUMENT_ROOT'].$user->avatar->url('medium')) ? $user->avatar->url('medium') : asset("img/faces/default_profile.png")) : asset("img/faces/default_profile.png")}}" class="img-responsive" />
      </div><!--col-md-4 col-sm-4 col-xs-12 close-->


      <div class="col-md-5 col-sm-5 col-xs-12">
        <h5>{{$user->name}}</h5>
        <p>{{$user->university}} </p>
        <ul>
          <li><span class="glyphicon glyphicon-briefcase"></span> {{$user->faculty}}</li>
          <li><span class="glyphicon glyphicon-envelope"></span><a href="#" title="mail">{{$user->email}}</a></li>
        </ul>
      </div><!--col-md-8 col-sm-8 col-xs-12 close-->
    </div><!--profile-head close-->
  </div><!--container close-->


  <div id="sticky" class="container">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs nav-menu" role="tablist">
      <li class="active">
        <a href="#profile" role="tab" data-toggle="tab">
          <i class="fa fa-male"></i> Profile
        </a>
      </li>
      <li>
        <a href="#change" role="tab" data-toggle="tab">
          <i class="fa fa-key"></i> Edit Profile
        </a>
      </li>
    </ul><!--nav-tabs close-->

    <!-- Tab panes -->
    <div class="tab-content">

      <div class="tab-pane fade active in" id="profile">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <h4 class="pro-title">Bio Graph</h4>
            </div><!--col-md-12 close-->

            <div class="col-md-6">
              <div class="table-responsive responsiv-table">
                <table class="table bio-table">
                  <tbody>
                  <tr>  
                    <td>@lang('register.mobile_number')</td>
                    <td>: {{$user->mobile_number}}</td> 
                  </tr>
                  <tr>      
                    <td>@lang('register.address')</td>
                    <td>: {{$user->address}}</td> 
                  </tr>
                  <tr>    
                    <td>@lang('register.country')</td>
                    <td>: Indonesia</td>       
                  </tr>
                </tbody>
              </table>
            </div><!--table-responsive close-->
          </div><!--col-md-6 close-->

          <div class="col-md-6">
            <div class="table-responsive responsiv-table">
              <table class="table bio-table">
                <tbody>
                <tr>  
                  <td>@lang('register.nim')</td>
                  <td>: {{$user->nim}}</td> 
                </tr>
                <tr>  
                  <td>@lang('register.major')</td>
                  <td>: {{$user->major}}</td> 
                </tr>
                <tr>  
                  <td>@lang('register.major')</td>
                  <td>: {{$user->faculty}}</td> 
                </tr>
              </tbody>
            </table>
          </div><!--table-responsive close-->
        </div><!--col-md-6 close-->

      </div><!--row close-->
    </div><!--container close-->
  </div><!--tab-pane close-->


  <div class="tab-pane fade" id="change">
    <div class="container fom-main">
      <div class="row">
        <div class="col-sm-12">
          <h2 class="register">Edit Your Profile</h2>
        </div><!--col-sm-12 close-->

      </div><!--row close-->
      <div class="row">
        <form class="form-horizontal main_form text-left" action="{{route("profile_update")}}" method="post" id="contact_form" enctype="multipart/form-data">
    {{ csrf_field() }}
          <fieldset>
          @include('user.user-field')

        <!-- upload profile picture -->
        <div class="col-md-12 text-left">
          <div class="uplod-picture">
            <img id="image" src="{{$user->avatar->url('medium') ? (file_exists($_SERVER['DOCUMENT_ROOT'].$user->avatar->url('medium')) ? $user->avatar->url('medium') : asset("img/faces/default_profile.png")) : asset("img/faces/default_profile.png")}}" alt="your image" class="img img-thumbnail" style="width: 300px; height: 300px;" />
            <span class="btn btn-default uplod-file">
              Update Photo <input type="file" name="avatar" accept="image/*" onchange="readURL(this);">
            </span>
          </div><!--uplod-picture close-->
        </div>
        <!--col-md-12 close-->

        <!-- Button -->
        <div class="form-group col-md-10">
          <div class="col-md-6">
            <button type="submit" class="btn btn-warning submit-button" >Save</button>
          </div>
        </div>
      </fieldset>
    </form>
  </div><!--row close-->
</div><!--container close -->          
</div><!--tab-pane close-->

</div><!--tab-content close-->
</div><!--container close-->
</div>

@endsection