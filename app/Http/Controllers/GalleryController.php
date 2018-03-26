<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use App\Gallery;

class GalleryController extends Controller
{
    public function index()
    {
        $language = session('locale') ? session('locale') : config('app.fallback_locale');
        $pictures = Gallery::with('category')->published()->orderBy('created_at', 'DESC')->limit(8)->get();
        $categories = Category::with(array('galleries' => function ($query) {
            $query->where('galleries.published', true);
        }))->get();

        $yearspics = ($pictures->count() < 1) ? null : range($pictures->max('created_at')->year, $pictures->min('created_at')->year);
        return view('gallery.index', compact('pictures', 'categories', 'language', 'yearspics'));
    }
    
    public function loadmore($id)
    {
        $pictures = Gallery::where('id', '<', $id)->with('category')->published()->orderBy('created_at', 'DESC')->get();
        return response(view('gallery.loadmore', compact('pictures')), 200, ['Content-Type' => 'text/plain']);
    }
    
    public function show($id, Request $request)
    {
        $language = session('locale') ? session('locale') : config('app.fallback_locale');
        $gallery = Gallery::with('author', 'category')->find($id);
        
        return response(view('gallery.show', compact('gallery', 'language'))->render(), 200, ['Content-Type' => 'text/plain']);
    }
}