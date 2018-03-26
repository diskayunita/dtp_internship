<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\ArticleTranslation;
use App\Category;
use Validator;
use App\User;
use Auth;

class ArticleController extends Controller
{
    public function index()
    {
        $language = session('locale') ? session('locale') : config('app.fallback_locale');
        $searchInfo = false;
        $articles = Article::with('category')->published()->orderBy('updated_at', 'DESC')->get();
        $categories = Category::with('articles')->get();
        
        // recent article
        $recent = Article::with(['article_translations' => function ($query) use ($language) {
            $query->where('language', $language)->orderBy('created_at', 'desc');
        }])->published()->take(6)->get();

        // popular article
        $popular = Article::orderBy('total_view', 'desc')->with(['article_translations' => function ($query) use ($language) {
            $query->where('language', $language)->orderBy('created_at', 'desc');
        }])->published()->take(6)->get();

        return view('article.index', compact('language', 'categories', 'articles', 'recent', 'popular', 'searchInfo'));
    }

    public function show($slug)
    {
        $language = session('locale') ? session('locale') : config('app.fallback_locale');

        //yang difilter hanya slugnya saja karna Sluggable membuat slug yang unique
        $article = ArticleTranslation::where('slug',$slug)->with('article')->first();
        $totalView = Article::find($article->article_id);

        $totalView->total_view = $totalView->total_view+1;
        $totalView->update();

        $article =  ArticleTranslation::where([ ['article_id', '=', $article->article_id], ['language', '=', $language], ])->with(['article', 'comments' => function ($query) {
            $query->orderBy('created_at', 'DESC');
        }])->first();

        $recent = Article::with(['article_translations' => function ($query) use ($language) {
            $query->where('language', $language)->orderBy('created_at', 'desc');
        }])->published()->limit(6)->get();

        $popular = Article::orderBy('total_view', 'desc')->with(['article_translations' => function ($query) use ($language) {
            $query->where('language', $language)->orderBy('created_at', 'desc');
        }])->published()->limit(6)->get();

        $categories = Category::all();

        $category = Category::where('id', $article->article->category->id)->get();

        if ($article->article->published) {
            return view('article.show', compact('article', 'recent', 'popular', 'language', 'categories', 'category'));
        }

        return redirect('/');
    }

    public function comment(Request $request, $id)
    {
        $article = ArticleTranslation::find($id);

        $data = $request->all();
        $rules = array(
            'comment' => 'required',
            'g-recaptcha-response' => 'required|captcha|min:1',
        );

        $validator = Validator::make($data, $rules);
        Auth::user()->comment($article, $data['comment'], 2);

        if ($validator->fails()) {
            return redirect(route('single-article', $article->slug))->withErrors($validator);
        } else {
            flash('comments has been sent successfully', 'success');
            return redirect(route('single-article', $article->slug));
        }
    }

    protected function countShare(Request $req) 
    {
        \DB::beginTransaction();
        try {
            $article = Article::find($req->id);
            $article->total_share=$article->total_share+1;
            $article->timestamps = false;
            $article->update();
            \DB::commit();
            $res='true';
        } catch (\Exception $e) {
            $res=$e;
            \DB::rollback();
        }
        return \Response::json($res);
    }

    public function search(Request $request)
    {
        $language = session('locale') ? session('locale') : config('app.fallback_locale');
        $article = ArticleTranslation::where('slug', $request->search)->first();
        $articleOther = ArticleTranslation::where('slug', 'like', '%'.$request->search.'%')->get();
        $searchInfo = true;

        if ($article) {
            $articles = Article::where('id', $article->article_id)->get();
        } else {
            $searchInfo = false;
            $articles = Article::published()->whereIn('id', $articleOther->pluck('article_id'))->orderBy('created_at', 'DESC')->get();
        }
        
        $categories = Category::all();

        $recent = Article::with(['article_translations' => function ($query) use ($language) {
            $query->where('language', $language)->orderBy('created_at', 'desc');
        }])->published()->take(6)->get();

        $popular = Article::orderBy('total_view', 'desc')->with(['article_translations' => function ($query) use ($language) {
            $query->where('language', $language)->orderBy('created_at', 'desc');
        }])->published()->take(6)->get();

        return view('article.index', compact('language', 'categories', 'articles', 'recent', 'popular', 'searchInfo'));
    }
}