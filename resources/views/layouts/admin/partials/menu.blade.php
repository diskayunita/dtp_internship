<li class="{{Request::is('admin') ? 'active' : ''}}">
  <a href="{{route('admin.dashboards')}}">
    <i class="ti-panel"></i>
    <p>Dashboard</p>
  </a>
</li>

{{-- Manage Content --}}
<li class="{{Request::is('admin/content*') ? 'active' : ''}}">
  <a data-toggle="collapse" href="#manageContent" aria-expanded="{{Request::is('admin/content*') ? 'true' : 'false'}}">
    <i class="ti-package"></i>
    <p>Manage Content
      <b class="caret"></b>
    </p>
  </a>
  <div class="{{Request::is('admin/content*') ? 'collapse in' : 'collapse'}}" id="manageContent">
    <ul class="nav">
      <li class="{{Request::is('admin/content/category*') ? 'active' : ''}}">
        <a href="{{route('admin.category.index')}}">
          <span class="sidebar-mini">
            <i class="ti-ink-pen"></i>
          </span>
          <span class="sidebar-normal">Category{{--  Article --}}</span>
        </a>
      </li>

      <li class="{{Request::is('admin/content/article*') ? 'active' : ''}}">
        <a href="{{route('admin.article.index')}}">
          <span class="sidebar-mini">
            <i class="ti-book"></i>
          </span>
          <span class="sidebar-normal">Article</span>
        </a>
      </li>

      <li class="{{Request::is('admin/content/gallery*') ? 'active' : ''}}">
        <a href="{{route('admin.gallery.index')}}">
          <span class="sidebar-mini">
            <i class="ti-gallery"></i>
          </span>
          <span class="sidebar-normal">Gallery</span>
        </a>
      </li>

      {{--<li class="{{Request::is('admin/content/showcase*') ? 'active' : ''}}">
        <a href="{{route('admin.showcase.index')}}">
          <span class="sidebar-mini">
            <i class="ti-package"></i>
          </span>
          <span class="sidebar-normal">Product</span>
        </a>
      </li>--}}
    </ul>
  </div>
</li>

{{-- Manage slider --}}

<li class="{{Request::is('admin/slider') ? 'active' : ''}}">
  <a href="{{route('admin.slider.index')}}">
    <i class="ti-layout-slider"></i>
    <p>Manage Slider</p>
  </a>
</li>

{{--<li>
  <a data-toggle="collapse" href="#manageSlider">
    <i class="ti-image"></i>
    <p>Manage Slider
      <b class="caret"></b>
    </p>
  </a>

  <div class="collapse" id="manageSlider">
    <ul class="nav">
      <li class="{{Request::is('admin/slider*') ? 'active' : ''}}">
        <a href="{{route('admin.slider.index')}}">
          <span class="sidebar-mini">
           <i class="ti-layout-slider-alt"></i>
         </span>
         <span class="sidebar-normal">Home Slider</span>
       </a>
     </li>

     <li class="">
      <a href="{{route('admin.slider.index')}}">
        <span class="sidebar-mini">
         <i class="ti-layout-slider-alt"></i>
       </span>
       <span class="sidebar-normal">About Us</span>
     </a>
   </li>
 </ul>
</div>
</li>--}}
{{-- Manage Contact --}}
@if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('superadmin'))
<li class="{{Request::is('admin/contact*') ? 'active' : ''}}">
  <a href="{{route('admin.contact.index')}}">
    <i class="ti-email"></i>
    <p>Manage Contact
      @if(countUnreadContact() > 0)
      <span class="badge">{{countUnreadContact()}}</span>
      @endif
    </p>
  </a>
</li>
@endif


{{-- Manage Events  --}}
@if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('superadmin'))
<li class="{{Request::is('admin/kunjungan*') ? 'active' : ''}}">
  <a data-toggle="collapse" href="#manageEvent" aria-expanded="{{Request::is('admin/kunjungan*') ? 'true' : 'false'}}">
    <i class="ti-calendar"></i>
    <p>Manage Event
      @if(countPendingEvents() > 0)
        <span class="label label-info" title="New/Revised Event"><b>{{countPendingEvents()}}</b></span>
      @endif
      <b class="caret"></b>
    </p>
  </a>
  <div class="{{Request::is('admin/kunjungan*') ? 'collapse in' : 'collapse'}}" id="manageEvent">
    <ul class="nav">
    @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('superadmin'))
    <li class="{{Request::is('admin/kunjungan/event*') ? 'active' : ''}}">
      <a href="{{route('admin.event.index')}}">
        <span class="sidebar-mini">
         <i class="ti-mouse-alt"></i>
       </span>
       <span class="sidebar-normal">
        Registered
        @if(countPendingEvents() > 0)
        <span class="label label-info" title="New/Revised Event"><b>{{countPendingEvents()}}</b></span>
      @endif
      </span>
    </a>
  </li>
  @endif
    @if(Auth::user()->hasRole('superadmin'))
      <li class="{{Request::is('admin/kunjungan/purpose*') ? 'active' : ''}}">
        <a href="{{route('admin.purpose.index')}}">
          <span class="sidebar-mini">
           <i class="ti-target"></i>
         </span>
         <span class="sidebar-normal">
          Internship Location
        </span>
      </a>
    </li>
    @endif
    @if(Auth::user()->hasRole('superadmin'))
      <li class="{{Request::is('admin/kunjungan/type*') ? 'active' : ''}}">
        <a href="{{route('admin.type.index')}}">
          <span class="sidebar-mini">
            <i class="ti-target"></i>
          </span>
          <span class="sidebar-normal">
            Internship Period
          </span>
        </a>
      </li>
    @endif
@if(Auth::user()->hasRole('superadmin'))
  <li class="{{Request::is('admin/kunjungan/product*') ? 'active' : ''}}">
    <a href="{{route('admin.product.index')}}">
      <span class="sidebar-mini">
       <i class="ti-target"></i>
     </span>
     <span class="sidebar-normal">
      Job Area
    </span>
  </a>
</li>

<li class="{{Request::is('admin/kunjungan/university*') ? 'active' : ''}}">
  <a href="{{route('admin.university.index')}}">
    <span class="sidebar-mini">
     <i class="ti-target"></i>
   </span>
   <span class="sidebar-normal">
    University Type
  </span>
</a>
</li>

<li class="{{Request::is('admin/kunjungan/blokeddate*') ? 'active' : ''}}">
      <a href="{{route('admin.blokeddate.index')}}">
        <span class="sidebar-mini">
          <i class="ti-target"></i>
        </span>
        <span class="sidebar-normal">
          Blocked Date
        </span>
      </a>
    </li>
@endif
</ul>
</div>
</li>
@endif

{{--Manage User --}}
@role('superadmin')
<li class="{{Request::is('admin/user*') ? 'active' : ''}}">
  <a data-toggle="collapse" href="#manageUser" aria-expanded="{{Request::is('admin/user*') ? 'true' : 'false'}}">
    <i class="ti-user"></i>
    <p>Manage User
      <b class="caret"></b>
    </p>
  </a>
  <div class="{{Request::is('admin/user*') ? 'collapse in' : 'collapse'}}" id="manageUser">
    <ul class="nav">
      <li class="{{Request::is('admin/user/role*') ? 'active' : ''}}">
        <a href="{{route('admin.role.index')}}">
          <span class="sidebar-mini">
           <i class="ti-mouse-alt"></i>
         </span>
         <span class="sidebar-normal">Role</span>
       </a>
     </li>

     <li class="{{Request::is('admin/user/permission*') ? 'active' : ''}}">
      <a href="{{route('admin.permission.index')}}">
        <span class="sidebar-mini">
         <i class="ti-unlock"></i>
       </span>
       <span class="sidebar-normal">Permission</span>
     </a>
   </li>

   <li class="{{Request::is('admin/user/manage*') ? 'active' : ''}}">
    <a href="{{route('admin.manage.index')}}">
      <span class="sidebar-mini">
       <i class="ti-unlock"></i>
     </span>
     <span class="sidebar-normal">User Admin</span>
   </a>
 </li>

 <li class="{{Request::is('admin/user/non-admin*') ? 'active' : ''}}">
  <a href="{{route('admin.non-admin.index')}}">
    <span class="sidebar-mini">
     <i class="ti-unlock"></i>
   </span>
   <span class="sidebar-normal">User NonAdmin</span>
 </a>
</li>
</ul>
</div>
</li>
@endrole
{{--Manage About Us --}}
<li class="{{Request::is('admin/user*') ? 'active' : ''}}">
  <a data-toggle="collapse" href="#manageAboutUs" aria-expanded="{{Request::is('admin/user*') ? 'true' : 'false'}}">
    <i class="ti-layout-grid2"></i>
    <p>Manage About Us
      <b class="caret"></b>
    </p>
  </a>
  <div class="{{Request::is('admin/about*') ? 'collapse in' : 'collapse'}}" id="manageAboutUs">
    <ul class="nav">
      <li class="{{Request::is('admin/about*') ? 'active' : ''}}">
        <a href="{{route('admin.about.index')}}">
          <span class="sidebar-mini">
           <i class="ti-video-clapper"></i>
         </span>
         <span class="sidebar-normal">Description & Video</span>
       </a>
     </li>

     <li class="{{Request::is('admin/crew*') ? 'active' : ''}}">
      <a href="{{route('admin.crew.index')}}">
        <span class="sidebar-mini">
         <i class="ti-user"></i>
       </span>
       <span class="sidebar-normal">Team</span>
     </a>
   </li>

   <li class="{{Request::is('admin/division*') ? 'active' : ''}}">
    <a href="{{route('admin.division.index')}}">
      <span class="sidebar-mini">
       <i class="ti-pin-alt"></i>
     </span>
     <span class="sidebar-normal">Division</span>
   </a>
 </li>
</ul>
</div>
</li>

{{--<li class="{{Request::is('admin/crew*') ? 'active' : ''}}">
<a href="{{route('admin.crew.index')}}">
  <i class="ti-user"></i>
  <p>Manage Crew</p>
</a>
</li>--}}
@if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('superadmin'))
<li class="{{Request::is('admin/survey*') ? 'active' : ''}}">
  <a href="{{route('admin.survey.index')}}">
    <i class="ti-clipboard"></i>
    <p>Manage Survey</p>
  </a>
</li>
@endif
