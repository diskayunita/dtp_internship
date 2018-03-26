<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
// use App\Notifications\showcaseCompleted;

use App\Showcase;
use App\ShowcaseTranslation;

class ShowcaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
  
    public function index()
    {
        $showcases = Showcase::orderBy('created_at', 'desc')->get();
        $title = "Showcase List";
    
        return view('admin.showcase.index', compact('showcases', 'title'));
    }
  
    public function create()
    {
        $showcase = new Showcase();
        $title = "Create Showcase";
        return view('admin.showcase.create', compact('showcase', 'title', 'categories'));
    }
  
    public function store(Request $request)
    {
        $input = $request->all();
        $showcase = new Showcase();
        $showcase->admin_id    = Auth::guard('admin')->user()->id;
        $showcase->image = (isset($input['image']) ? $input['image'] : '');
        $showcase_translation = new ShowcaseTranslation;
    
        foreach (config('app.languages') as $key=>$lang) {
            $input['title'][$key] = isset($input['title'][$key]) ? $input['title'][$key] : current(array_filter($input['title']));
            $input['content'][$key] = isset($input['content'][$key]) ? $input['content'][$key] : current(array_filter($input['content']));
            $input['image_desc'][$key] = isset($input['image_desc'][$key]) ? $input['image_desc'][$key] : current(array_filter($input['image_desc']));
        }

        $param_showcase['title'] = $input['title'][0];
        $param_showcase['content'] = $input['content'][0];
        $param_showcase['image_desc'] = $input['image_desc'][0];
    
        if ($showcase_translation->validate($param_showcase)) {
            if ($showcase->save()) {
                foreach(config('app.languages') as $key=>$lang) {
                    $showcase->translation()->save(
                        new ShowcaseTranslation([
                            'title'     => isset($input['title'][$key]) ? $input['title'][$key] : current(array_filter($input['title'])),
                            'language'  => $lang,
                            'content'   => isset($input['content'][$key]) ? $input['content'][$key] : current(array_filter($input['content'])),
                            'image_desc'=> isset($input['image_desc'][$key]) ? $input['image_desc'][$key] : current(array_filter($input['image_desc']))
                        ])
                    );
                }
            }
            $newshowcase = Showcase::with('translation')->find($showcase->id);
            $url     = route('admin.showcase.show', [$newshowcase->id]);
            $title = $newshowcase->translation('id')->first()->title;
            $message = "Showcase dengan judul #".$title." telah ditambahkan. detail showcase url : ".$url;
        
            flash('Showcase successfully created', 'success');
            return redirect(route('admin.showcase.index'));
        } else {
            return redirect(route('admin.showcase.create'))->withErrors($showcase_translation->errors())->withInput();
        }
    }
  
    public function edit($id)
    {
        $showcase = Showcase::find($id);
        $title = "Edit Showcase";
        
        return view('admin.showcase.edit', compact('showcase', 'title', 'categories'));
    }
  
    public function update(Request $request, $id)
    {
        $showcase = Showcase::find($id);
        $input= $request->all();
        $showcase->update([
            'image'=>(isset($input['image']) ? $input['image'] : '')
        ]);

        $showcase_translation = new ShowcaseTranslation;
    
        foreach (config('app.languages') as $key=>$lang) {
            $input['title'][$key] = isset($input['title'][$key]) ? $input['title'][$key] : current(array_filter($input['title']));
            $input['content'][$key] = isset($input['content'][$key]) ? $input['content'][$key] : current(array_filter($input['content']));
            $input['image_desc'][$key] = isset($input['image_desc'][$key]) ? $input['image_desc'][$key] : current(array_filter($input['image_desc']));
        }
    
        $param_showcase['title'] = $input['title'][0];
        $param_showcase['content'] = $input['content'][0];
        $param_showcase['image_desc'] = $input['image_desc'][0];
    
        if ($showcase_translation->validate($param_showcase)) {
            if ($showcase->save()) {
                foreach (config('app.languages') as $key=>$lang) {
                    if ($showcase->translation($lang)->first()) {
                        $showcase->translation($lang)->first()->update([
                            'title'     => isset($input['title'][$key]) ? $input['title'][$key] : current(array_filter($input['title'])),
                            'slug'     => isset($input['title'][$key]) ? str_slug($input['title'][$key].'-'.$lang, '-') : str_slug(current(array_filter($input['title'])).'-'.$lang, '-'),
                            'language'  => $lang,
                            'content'   => isset($input['content'][$key]) ? $input['content'][$key] : current(array_filter($input['content'])),
                            'image_desc'=> isset($input['image_desc'][$key]) ? $input['image_desc'][$key] : current(array_filter($input['image_desc']))
                        ]);
                    }
                }
        
                flash('Showcase successfully updated', 'success');
                $url     = route('admin.showcase.show', [$showcase->id]);
                $message = "Artikel dengan url ".$url." telah diperbarui";
                return redirect(route('admin.showcase.index'));
            }
        } else {
            return redirect(route('admin.showcase.create'))->withErrors($showcase_translation->errors())->withInput();
        }
    }
  
    public function publish($id)
    {
        $showcase = Showcase::find($id);

        if ($showcase) {
            $showcase->update(['published'  => 1]);
            flash('Showcase successfully published', 'success');
        
            $showcasepublished = Showcase::with('translation')->find($showcase->id);
            $url     = route('admin.showcase.show',[$showcasepublished->id]);
            $title = $showcasepublished->translation('id')->first()->title;
            $message = "Showcase dengan judul #".$title." telah dipublish oleh superadmin. detail showcase url : ".$url;
        } else {
            flash('Showcase not found', 'error');
        }
    
        return redirect(route('admin.showcase.index'));
    }
  
    public function unpublish($id)
    {
        $showcase = Showcase::find($id);
        
        if ($showcase) {
            $showcase->update(['published'  => 0]);  
            if ($showcase->highlight) {
                $showcase->update(['highlight'  => 0]);
            }
        
            flash('Showcase successfully unpublished', 'success');
        
            $showcaseunpublished = Showcase::with('translation')->find($showcase->id);
            $url     = route('admin.showcase.show', [$showcaseunpublished->id]);
            $title = $showcaseunpublished->translation('id')->first()->title;
            $message = "Showcase dengan judul #".$title." telah diunpublish oleh superadmin. detail showcase url : ".$url;
        } else {
            flash('Showcase not found', 'error');
        }
    
        return redirect(route('admin.showcase.index'));
    }
  
    public function destroy($id)
    {
        $showcase = Showcase::with('translation')->find($id);
    
        if ($showcase) {
            $titleShowcase = $showcase->translation('id')->first();
            $title = $titleShowcase ? $titleShowcase->title : "-";
            if ($showcase->showcase_translation()) {
                $showcase->showcase_translation()->delete();
            }
            $message = "Showcase dengan judul #".$title." telah dihapus";
            $showcase->delete();
        }
    
        return redirect(route('admin.showcase.index'));
    }
  
    public function show($id)
    {
        $showcase = Showcase::find($id);
        $title = "Detail Showcase";
        return view('admin.showcase.show', compact('showcase', 'title', 'categories'));
    }
}
