<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Showcase;
use App\ShowcaseTranslation;
// use App\Category;
use Validator;
use App\User;
use Auth;

class ShowcaseController extends Controller
{
    public function index()
    {
        $language = session('locale') ? session('locale') : config('app.fallback_locale');

        $showcases = Showcase::published()->orderBy('created_at','DESC')->get();
        // $categories = Category::all();
    
        return view('showcase.index',compact('language','categories','showcases'));
    }

    public function show($slug)
    {
        $language = session('locale') ? session('locale') : config('app.fallback_locale');

        //yang difilter hanya slugnya saja karna Sluggable membuat slug yang unique
        $showcase = ShowcaseTranslation::where('slug',$slug)->with('showcase')->first();
        $totalView=Showcase::find($showcase->showcase_id);
        $totalView->total_view=$totalView->total_view+1;
        $totalView->update();
        $showcase =  ShowcaseTranslation::where([
            ['showcase_id', '=', $showcase->showcase_id],
            ['language', '=', $language],
        ])->with('showcase')->first();

        $recent = Showcase::with(['showcase_translation' => function ($query) use ($language) {
            $query->where('language', $language)->orderBy('created_at', 'desc');
        }])->published()->limit(6)->get();

        $popular = Showcase::orderBy('total_view', 'desc')->with(['showcase_translation' => function ($query) use ($language) {
            $query->where('language', $language)->orderBy('created_at', 'desc');
        }])->published()->limit(6)->get();

        if ($showcase->showcase->published) {
            return view('showcase.show', compact('showcase', 'recent', 'popular', 'language', 'categories', 'category'));
        }

        return redirect('/');
    }

    public function comment(Request $request, $id)
    {
        $showcase = ShowcaseTranslation::find($id);

        $data = $request->all();
        $rules = array(
            'comment' => 'required',
            'g-recaptcha-response' => 'required|captcha|min:1',
        );

        $validator = Validator::make($data, $rules);
        Auth::user()->comment($showcase, $data['comment'], 2);

        if ($validator->fails()) {
            return redirect(route('single-showcase', $showcase->slug))->withErrors($validator);
        } else {
            flash('comments has been sent successfully', 'success');
            return redirect(route('single-showcase', $showcase->slug));
        }
    }

    protected function countShare(Request $req)
    {
        \DB::beginTransaction();
        try {
            $showcase=Showcase::find($req->id);
            $showcase->total_share=$showcase->total_share+1;
            $showcase->timestamps =false;
            $showcase->update();
            \DB::commit();
            $res='true';
        } catch (\Exception $e) {
            $res=$e;
            \DB::rollback();
        }
        return \Response::json($res);
    }
}
