<?php

namespace App\Http\Controllers;

use App\Slider;
use Illuminate\Http\Request;
use App\About_translation;
use App\About;
use App\Crew;
use App\Division;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $language = session('locale') ? session('locale') : config('app.fallback_locale');

        $about = About::all();

        /* get slider image Limit to latest 4 slide */
        $sliders = Slider::published()->where(['display_page' => 'about'])->with(['slider_translations' => function ($query) use ($language) { 
            $query->where(['language' => $language])->orderBy('created_at', 'desc'); 
        }])->limit(4)->get();

        /* get our team list */
        $teams = Crew::all();
        $divisions = Division::all();

        /* Return The View */
        return view('about.index', [ 'teams' => $teams, 'divisions' => $divisions, 'about' => $about, 'language' => $language, 'sliders' => $sliders ]);
    }
}
