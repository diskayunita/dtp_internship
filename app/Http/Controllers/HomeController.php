<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Article;
use App\Admin;
use App\ArticleTranslation;
use App\Slider;
use App\Category;
use App\Gallery;
use App\Event;
use App\Contact;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
//use Spatie\GoogleCalendar\Event as GoogleCalendar;

class HomeController extends Controller
{
    public function index()
    {
        $language = session('locale') ? session('locale') : config('app.fallback_locale');

        // Erlier article
        $articles = Article::with(['article_translations' => function ($query) use ($language) {
            $query->where('language', $language);
        }])->published()->take(3)->get();

        // recent article
        $recent = Article::with(['article_translations' => function ($query) use ($language){
            $query->where('language', $language)->orderBy('created_at', 'desc');
        }])->published()->take(6)->get();

        // popular article
        $popular = Article::orderBy('total_view', 'desc')->with(['article_translations' => function ($query) use ($language){
            $query->where('language', $language)->orderBy('created_at', 'desc');
        }])->published()->take(6)->get();
    
        $page_article = Article::published()->get();

        $sliders = Slider::where(['display_page' => 'home'])->with(['slider_translations' => function ($query) use ($language) {
            $query->where(['language' => $language])->orderBy('created_at', 'desc');
        }])->published()->limit(4)->get();

        $calendar = new \Edofre\Fullcalendar\Fullcalendar();

        // You can manually add the objects as an array
        // $events = $this->getEvents();
        // $calendar->setEvents($events);

        // Or you can add a route and return the events using an ajax requests that returns the events as json
        //$calendar->setEvents(route('fullcalendar-ajax-events'));

        // Set options
        $calendar->setOptions([
            'locale'      => session('locale'),
            'weekNumbers' => true,
            'selectable'  => true,
            'defaultView' => 'month',
            'height'      => 250,
            'eventClick' => new \Edofre\Fullcalendar\JsExpression("function(event, jsEvent, view) {}"),
            'viewRender' => new \Edofre\Fullcalendar\JsExpression('function( view, element ) {}'),
        ]);

        // Check out the documentation for all the options and callbacks.
        // https://fullcalendar.io/docs/

        $galleries = Gallery::published()->take(15)->orderBy('created_at', 'DESC')->get();

        /* Get Nearest Event List */
        $nearest_event = Event::where('approval', 'approved')
            ->where('start_date', '>=', Carbon::today())
            ->orderBy('start_date', 'ASC')
            ->limit(18)
            ->get();

        $events = []; // array placeholder
        foreach ($nearest_event as $key => $event) {
            $date = new Carbon($event->start_date);
            $start_date = $date->format('Y-m-d');
            // create array from looped data
            $events[$start_date][] = [
                'start_date' => $start_date,
                'agency_type' => $event->agencies,
                'agency_name' => $event->agencyname,
                'session' => $event->session
            ];
        }
        // slice the array size into 3
        $events = array_slice($events, 0, 3);

        return view('home.index', [
            'calendar' => $calendar,
            'articles' => $articles,
            'popular' => $popular,
            'recent'=>$recent,
            'page_article'=>$page_article,
            'language'=>$language,
            'sliders'=>$sliders,
            'galleries'=>$galleries,
            'nearest_event' => $nearest_event,
            'events' => $events,
        ]);
    }

    /**
     * @param Request $request
     * @return string
     */
    public function ajaxEvents(Request $request)
    {
        // start and end dates will be sent automatically by fullcalendar, they can be obtained using:
        // $request->get('start') & $request->get('end')
        $events = $this->getEvents();

        return json_encode($events);
    }

    /**
     * @return array
     */
    private function getEvents()
    {
        $events = [];

        $events_data = Event::where('approval', 'approved')->get();
        foreach ($events_data as $key => $event) {
            $date_start = Carbon::parse($event->start_date);
            $date_end = Carbon::parse($event->end_date);
            $events[] = new \Edofre\Fullcalendar\Event([
                'id'     => $event->id,
                'title'  => $event->agencyname,
                'allDay' => true,
                'start'  => Carbon::create($date_start->format('Y'), $date_start->format('m'), $date_start->format('d')),
                //'end'  => Carbon::create($date_end->format('Y'), $date_end->format('m'), $date_end->format('d')),
                'backgroundColor' => 'red'
            ]);
        }

        return $events;
    }

    public function upload() {
        // getting all of the post data
        $file = array('upload' => Input::file('image'));
    
        // setting up rules
        $rules = array('upload' => 'required',); //mimes:jpeg,bmp,png and for max size max:10000
    
        // doing the validation, passing post data, rules and the messages
        // checking file is valid.
        if (Input::file('upload')->isValid()) {
            $destinationPath = 'files'; // upload path
            $extension = Input::file('upload')->getClientOriginalExtension(); // getting image extension
            $fileName = rand(11111, 99999).'.'.$extension; // renameing image
            Input::file('upload')->move($destinationPath, $fileName); // uploading file to given path
            // sending back with message
            return json_encode("uploaded");
        } else {
            // sending back with error message.
            return json_encode("error");
        }
    }

    public function gallery()
    {
        $language = session('locale') ? session('locale') : config('app.fallback_locale');
        $pictures = Gallery::all();
        $categories = Category::all();
        return view('home.gallery', compact('pictures', 'categories', 'language'));
    }
}
