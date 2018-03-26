<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\About;
use App\About_translation;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $abouts = About::all();
        $title = "About List";
        return view('admin.about.index', compact('abouts', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $about = new About();
        $title = "Create About";
        return view('admin.about.create',compact('about', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $about = new About();

        $about->admin_id    = Auth::guard('admin')->user()->id;
        $about->video = (isset($input['video']) ? $input['video'] : '');

        if ($about->save()) {
            foreach (config('app.languages') as $key=>$lang) {
                $about->translation()->save(
                    new About_translation([
                        'language'  => $lang,
                        'content'   => isset($input['content'][$key]) ? $input['content'][$key] : current(array_filter($input['content']))
                    ])
                );
            }
        }
        
        flash('About successfully created', 'success');
        return redirect(route('admin.about.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $about = About::find($id);
        $title = "Detail Article";

        return view('admin.about.show', compact('about','title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $about = About::find($id);
        $title = "Edit About";
        return view('admin.about.edit', compact('about','title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $about = About::find($id);

        $input= $request->all();

        $about->update(['video'=>(isset($input['video']) ? $input['video'] : '')]);
        
        if ($about->save()) {
            foreach (config('app.languages') as $key=>$lang) {
                if ($about->translation($lang)->first()) {
                    $about->translation($lang)->first()->update([
                        'language'  => $lang,
                        'content'   => isset($input['content'][$key]) ? $input['content'][$key] : current(array_filter($input['content']))
                    ]);
                }
            }
            flash('Article successfully updated', 'success');
        }
    
        return redirect(route('admin.about.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $about = About::find($id);

        if ($about && $about->about_translations()->delete()) {
            $about->delete();
        }

        return redirect(route('admin.about.index'));
    }
}
