<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\SliderTranslation;
use App\Slider;

class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
  
    public function index()
    {
        $sliders = Slider::all();
        $title = "Slider List";
        return view('admin.slider.index', compact('sliders', 'title'));
    }
  
    public function create()
    {
        $slider = new Slider();
        $title = "Slider Create";
        return view('admin.slider.create', compact('slider', 'title'));
    }
  
    public function store(Request $request)
    {
        $input = $request->all();
        $slider = new Slider();
        $slider->admin_id = Auth::guard('admin')->user()->id;
        $slider->display_page = $input['display_page'];
        $slider->image = (isset($input['image']) ? $input['image'] : '');
    
        if ($slider->save()) {
            foreach(config('app.languages') as $key=>$lang) {
                $slider->translation()->save(
                    new SliderTranslation([
                        'caption'     => isset($input['caption'][$key]) ? $input['caption'][$key] : current(array_filter($input['caption'])),
                        'language'  => $lang,
                        'referal_link'   => isset($input['referal_link'][$key]) ? $input['referal_link'][$key] : current(array_filter($input['referal_link'])),
                        'description'=> isset($input['description'][$key]) ? $input['description'][$key] : current(array_filter($input['description']))
                    ])
                );
            }
            
            flash('Slider successfully created', 'success');
        } else {
            flash('Slider unsuccessfully created', 'error');
        }

        return redirect(route('admin.slider.index'));
    }
  
    public function edit($id)
    {
        $slider = Slider::find($id);
        $title = 'Slider Edit';
        return view('admin.slider.edit', compact('slider', 'title'));
    }
  
    public function update(Request $request, $id)
    {
        $input = $request->all();
      
        $slider = Slider::find($id);

        if ($slider) {
            $slider->update([
                'display_page' => (isset($input['display_page']) ? $input['display_page'] : ''),
                'image' => (isset($input['image']) ? $input['image'] : ''),
            ]);
          
            foreach (config('app.languages') as $key=>$lang) {
                if ($slider->translation($lang)->first()) {
                    $slider->translation($lang)->first()->update([
                        'caption' => isset($input['caption'][$key]) ? $input['caption'][$key] : current(array_filter($input['caption'])),
                        'language' => $lang,
                        'referal_link' => isset($input['referal_link'][$key]) ? $input['referal_link'][$key] : current(array_filter($input['referal_link'])),
                        'description' => isset($input['description'][$key]) ? $input['description'][$key] : current(array_filter($input['description']))
                    ]);
                }
            }
            flash('Slider successfully updated', 'success');
        } else {
            flash('Slider not found', 'error');
        }
    
        return redirect(route('admin.slider.index'));
    }
  
    public function show($id)
    {
        $slider = Slider::find($id);
        $title = 'Slider Details';
        return view('admin.slider.detail', compact('slider', 'title'));
    }

    public function destroy($id)
    {
        $slider = Slider::find($id);

        if ($slider) {
            if ($slider->slider_translations()) {
                $slider->slider_translations()->delete();
            }
            $slider->delete();
            flash('Slider successfully deleted', 'success');
        } else {
            flash('Slider unsuccessfully deleted', 'error');
        }

        return redirect(route('admin.slider.index'));
    }
  
    public function publish($id)
    {
        $article = Slider::find($id);
        $article->update(['published'  => 1]);
        flash('Slider successfully publish', 'success');
    
        return redirect(route('admin.slider.index'));
    }
  
    public function unpublish($id)
    {
        $slider = Slider::find($id);

        if ($slider) {
            $slider->update(['published'  => 0]);
            flash('Slider successfully unpublish', 'success');
        } else {
            flash('Slider not found', 'error');
        }
        return redirect(route('admin.slider.index'));
    }
}
