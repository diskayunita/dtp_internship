<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Notifications\GalleryCompleted;

use App\Gallery;
use App\GalleryTranslation;
use App\Category;

class GalleryController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $galleries = Gallery::all();
        $title = "Gallery List";
        return view('admin.gallery.index', compact('galleries', 'title'));
    }

    public function create()
    {
        $gallery = new gallery();
        $title = "gallery Create";
        $categories = Category::all();
        return view('admin.gallery.create', compact('gallery', 'title', 'categories'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $gallery = new gallery();
        $gallery->admin_id = Auth::guard('admin')->user()->id;
        $gallery->category_id = $input['category_id'];
        $gallery->image = isset($input['image']) ? $input['image'] : '';
    
        if ($gallery->save()) {
            foreach (config('app.languages') as $key=>$lang) {
                $gallery->translation()->save(
                    new GalleryTranslation([
                        'caption'     => isset($input['caption'][$key]) ? $input['caption'][$key] : current(array_filter($input['caption'])),
                        'language'  => $lang,
                        'description'=> isset($input['description'][$key]) ? $input['description'][$key] : current(array_filter($input['description']))
                    ])
                );
            }
        
            $newgallery = Gallery::with('translation')->find($gallery->id);
            $url     = route('admin.gallery.show',[$newgallery->id]);
            $title = $newgallery->translation('id')->first()->caption;
            $message = "Gallery dengan caption #".$title." telah ditambahkan. detail gallery url : ".$url;
            Auth::guard('admin')->user()->notify(new GalleryCompleted($gallery, $message));
            flash('Gallery successfully created', 'success');
        } else {
            flash('Gallery unsuccessfully created', 'error');
        }
        return redirect(route('admin.gallery.index'));
    }

    public function edit($id)
    {
        $gallery = Gallery::find($id);
        $title = 'Gallery Edit';
        $categories = Category::all();
        return view('admin.gallery.edit', compact('gallery', 'title','categories'));
    }

    public function update(Request $request, $id)
    {
        $gallery = Gallery::find($id);
        $input= $request->all();
    
        foreach (config('app.languages') as $key=>$lang) {
            if ($gallery->translation($lang)->first()) {
                $gallery->translation($lang)->first()->update([
                    'caption'     => isset($input['caption'][$key]) ? $input['caption'][$key] : $gallery->translation($lang)->first()->caption,
                    'language'  => $lang,
                    'description'=> isset($input['description'][$key]) ? $input['description'][$key] : $gallery->translation($lang)->first()->description
                ]);
            }
        }
    
        $gallery->image = isset($input['image']) ? $input['image'] : '';
        $gallery->category_id = $input['category_id'];
    
        if ($gallery->save()) {
            $updategallery = Gallery::with('translation')->find($gallery->id);
            $url     = route('admin.gallery.show', [$updategallery->id]);
            $title = $updategallery->translation('id')->first()->caption;
            $message = "Gallery dengan caption #".$title." telah diperbarui. detail gallery url : ".$url;
            Auth::guard('admin')->user()->notify(new GalleryCompleted($gallery, $message));
            flash('Gallery update successfully', 'success');
        }
    
        return redirect(route('admin.gallery.index'));
    }

    public function show($id)
    {
        $gallery = Gallery::find($id);
        $title = 'Gallery Edit';
        $category = Category::find($gallery->category_id)->name;
        return view('admin.gallery.detail', compact('gallery', 'title', 'category'));
    }

    public function destroy($id)
    {
        $gallery = Gallery::find($id);
        if ($gallery) {
            if ($gallery->gallery_translations()) {
                if ($gallery->gallery_translations()->delete()) {
                    $gallery->delete();
                    flash('Gallery has been deleted', 'success');
                }
            }
        } else {
            flash('Gallery unsuccessfully deleted', 'error');
        }
        return redirect(route('admin.gallery.index'));
    }

    public function publish($id)
    {
        $gallery = Gallery::find($id);

        if ($gallery) {
            $gallery->update(['published'  => 1]);
            $gallerypublished = Gallery::with('translation')->find($gallery->id);
            $url     = route('admin.gallery.show', [$gallerypublished->id]);
            $title = $gallerypublished->translation('id')->first()->caption;
            $message = "Gallery dengan caption #".$title." telah dipublish. detail gallery url : ".$url;
            Auth::guard('admin')->user()->notify(new GalleryCompleted($gallery, $message));
            flash('Gallery successfully publish', 'success');
        } else {
            flash('Gallery Not found', 'error');
        }

        return redirect(route('admin.gallery.index'));
    }

    public function unpublish($id)
    {
        $gallery = Gallery::find($id);
        
        if ($gallery) {
            $gallery->update(['published'  => 0]);
            $galleryunpublished = Gallery::with('translation')->find($gallery->id);
            $url     = route('admin.gallery.show', [$galleryunpublished->id]);
            $title = $galleryunpublished->translation('id')->first()->caption;
            $message = "Gallery dengan caption #".$title." telah diunpublish. detail gallery url : ".$url;
            Auth::guard('admin')->user()->notify(new GalleryCompleted($gallery, $message));
            flash('Gallery successfully unpublish', 'success');
        } else {
            flash('Gallery not found', 'error');
        }

        return redirect(route('admin.gallery.index'));
    }
}
