Hi {{ $name }}
<p>Your Registration is complete</p>
<a target="_blank" href="{{ route('confirmation' ,$token)}}">{{ route('confirmation' ,$token)}}</a>