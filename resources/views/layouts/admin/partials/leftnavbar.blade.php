@if(Auth::guard('admin')->user())
<ul class="nav navbar-nav">
    <li>
        <a href="{{route('admin.article.index')}}">Article</a>
    </li>
</ul>
@endif