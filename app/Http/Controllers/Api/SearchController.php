<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Laravel\Scout\Builder;
use App\Article;
use App\ArticleTranslation;
use App\Gallery;
use App\GalleryTranslation;
use Indonesia;

class SearchController extends Controller
{
    public function searchArticles(Request $request)
    {
        // Pertama, kita mendefinisikan pesan kesalahan yang akan kita tampilkan jika tidak ada kata kunci.
        // Atau ada kata kunci tapi tidak ditemukan hasil.
        $error = ['error' => 'No results found, please try with different keywords.'];

        // Ambil session bahasa
        $language = session('locale') ? session('locale') : config('app.fallback_locale');

        // Pastikan pengguna memasukkan kata kunci.
        if($request->has('q')) {

            $articlespublished = Article::published()->get()->pluck('id')->flatten();
            // Mencari sesuatu di tabel artikel dengan sintaks Scope "scopeSearch()" di Model ArticleTranslation.
            $articles = ArticleTranslation::Search($request->get('q'))->get();
            
            // Jika ada hasil maka keluarkan semua jika tidak maka munculkan pesan error.
            return $articles->where('language',$language)->whereIn('article_id', $articlespublished)->count() ?
                $articles->where('language',$language)->whereIn('article_id', $articlespublished) :
                $error;

        }

        // Keluarkan pesan kesalahan jika kata kunci tidak mempunyai hasil
        return $error;
    }

    public function searchGalleries(Request $request)
    {
        // Pertama, kita mendefinisikan pesan kesalahan yang akan kita tampilkan jika tidak ada kata kunci.
        // Atau ada kata kunci tapi tidak ditemukan hasil.
        $error = ['error' => 'No results found, please try with different keywords.'];

        // Ambil session bahasa
        $language = session('locale') ? session('locale') : config('app.fallback_locale');

        // Making sure the user entered a keyword.
        if($request->has('q')) {

            $galleriespublished = Gallery::published()->get()->pluck('id')->flatten();
            // Mencari sesuatu di tabel artikel dengan sintaks Scope "scopeSearch()" di Model GalleryTranslation.
            $pictures = GalleryTranslation::Search($request->get('q'))->with('gallery')->get();
            
            // Jika ada hasil maka keluarkan semua jika tidak maka munculkan pesan error.
            return $pictures->where('language',$language)->whereIn('gallery_id', $galleriespublished)->count() ?
                $pictures->where('language',$language)->whereIn('gallery_id', $galleriespublished) :
                $error;

        }

        // Keluarkan pesan kesalahan jika kata kunci tidak mempunyai hasil
        return $error;
    }
 
    public function city(Request $request)
    {
        $province = Indonesia::findProvince($request['province'], ['cities']);
        $cities = $province->cities;
        return $cities;
    }
}
