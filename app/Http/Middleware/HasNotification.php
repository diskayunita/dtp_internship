<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Schema;
use App\Event;
use Closure;

class HasNotification
{
	
	/**
	* Handle an incoming request.
	     *
	     * @param  \Illuminate\Http\Request  $request
	     * @param  \Closure  $next
	     * @return mixed
	     */
	    public function handle($request, Closure $next)
	    {
		$eventNotif=[];
		if (Schema::hasTable('events') && \Auth::check()) {
			$eventNotif=Event::where('user_id',\Auth::user()->id)->where('is_read',false)->get();
			view()->share('hasEventNotif', $eventNotif);
		}
		
		return $next($request);
	}
}
