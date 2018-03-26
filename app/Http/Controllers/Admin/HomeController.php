<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Gallery;
use App\Article;
use App\Event;
use App\User;

class HomeController extends Controller
{
    public function index()
    {
        $info_box['user'] = User::all()->count();
        $info_box['gallery'] = Gallery::all()->count();
        $info_box['article'] = Article::all()->count();
        $info_box['events'] = Event::all()->count();

        /* event dataset */
        $eventsData = Event::select('approval', \DB::raw('count(id) as count'))->groupBy('approval')->get();
        $event['label'] = $eventsData->pluck('approval');
        $event['count'] = $eventsData->pluck('count');
        $event['total'] = array_sum($event['count']->toArray());

        /* user dataset */
        $dataUser = User::userChart();
        $user['label'] = $dataUser->pluck('month_year');
        $user['count'] = $dataUser->pluck('user_count');
        $user['total'] = array_sum($user['count']->toArray());

        return view('admin.home', compact('info_box', 'event', 'user'));
    }
}
