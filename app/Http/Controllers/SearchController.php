<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;;
use App\Gallery;
use App\ArticleTranslation;
use App\GalleryTranslation;
use App\Category;

class SearchController extends Controller
{
    public function search(Request $request)
    {

        // Pertama, kita mendefinisikan pesan kesalahan yang akan kita tampilkan jika tidak ada kata kunci.
        // Atau ada kata kunci tapi tidak ditemukan hasil.
        $error = ['error' => 'No results found, please try with different keywords.'];

        // Ambil session bahasa
        $language = session('locale') ? session('locale') : config('app.fallback_locale');

        // Pastikan pengguna memasukkan kata kunci.
        if ($request->has('search_tdds')) {

            $articlespublished = Article::published()->get()->pluck('id')->flatten();
            $searcharticle = ArticleTranslation::Search($request->get('search_tdds'))->get();

            $gallerypublished = Gallery::published()->get()->pluck('id')->flatten();
            $searchgallery = GalleryTranslation::Search($request->get('search_tdds'))->get();

            $article = $searcharticle->where('language', $language)->whereIn('article_id', $articlespublished);
            $gallery = $searchgallery->where('language', $language)->whereIn('gallery_id', $gallerypublished);

            $result = $article->merge($gallery);
            
            // Jika ada hasil maka keluarkan semua jika tidak maka munculkan pesan error.
            return count($result) ? $result : $error;

        }

        // Keluarkan pesan kesalahan jika kata kunci tidak mempunyai hasil
        return $error;
    }
}
