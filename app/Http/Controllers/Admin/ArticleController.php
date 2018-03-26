<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Notifications\ArticleCompleted;

use App\Article;
use App\ArticleTranslation;
use App\Category;

class ArticleController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $articles = Article::orderBy('created_at', 'desc')->get();
        $title = "Article List";
        return view('admin.article.index', compact('articles', 'title'));
    }

    public function create()
    {
        $article = new Article();
        $title = "Create Article";
        $categories = Category::all();
        return view('admin.article.create', compact('article', 'title', 'categories'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
    
        $article = new Article();
    
        $article->admin_id    = Auth::guard('admin')->user()->id;
        $article->category_id = $input['category_id'];
        $article->image = (isset($input['image']) ? $input['image'] : '');
    
        $article_translation = new ArticleTranslation;
    
        foreach (config('app.languages') as $key=>$lang) {
            $input['title'][$key] = isset($input['title'][$key]) ? $input['title'][$key] : current(array_filter($input['title']));
            $input['content'][$key] = isset($input['content'][$key]) ? $input['content'][$key] : current(array_filter($input['content']));
            $input['image_desc'][$key] = isset($input['image_desc'][$key]) ? $input['image_desc'][$key] : current(array_filter($input['image_desc']));
        }
    
        $param_article['title'] = $input['title'][0];
        $param_article['content'] = $input['content'][0];
        $param_article['image_desc'] = $input['image_desc'][0];
    
        if ($article_translation->validate($param_article)) {
            if ($article->save()) {
                foreach (config('app.languages') as $key=>$lang) {
                    $article->translation()->save(
                        new ArticleTranslation([
                            'title'     => isset($input['title'][$key]) ? $input['title'][$key] : current(array_filter($input['title'])),
                            'language'  => $lang,
                            'content'   => isset($input['content'][$key]) ? $input['content'][$key] : current(array_filter($input['content'])),
                            'image_desc'=> isset($input['image_desc'][$key]) ? $input['image_desc'][$key] : current(array_filter($input['image_desc']))
                        ])
                    );
                }
            }
        
            $newarticle = Article::with('translation')->find($article->id);
            $url     = route('admin.article.show',[$newarticle->id]);
            $title = $newarticle->translation('id')->first()->title;
            $message = "Article dengan judul #".$title." telah ditambahkan. detail article url : ".$url;
            Auth::guard('admin')->user()->notify(new ArticleCompleted($article, $message));
            flash('Article successfully created', 'success');
            return redirect(route('admin.article.index'));
        } else {
            return redirect(route('admin.article.create'))->withErrors($article_translation->errors())->withInput();
        }
    }

    public function edit($id)
    {
        $article = Article::find($id);
        $title = "Edit Article";
        $categories = Category::all();
        return view('admin.article.edit', compact('article', 'title', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $article = Article::find($id);

        $input= $request->all();

        $article->update([
            'category_id'  => $input['category_id'], 
            'image'=>(isset($input['image']) ? $input['image'] : '')
        ]);

        $article_translation = new ArticleTranslation;

        foreach (config('app.languages') as $key=>$lang) {
            $input['title'][$key] = isset($input['title'][$key]) ? $input['title'][$key] : current(array_filter($input['title']));
            $input['content'][$key] = isset($input['content'][$key]) ? $input['content'][$key] : current(array_filter($input['content']));
            $input['image_desc'][$key] = isset($input['image_desc'][$key]) ? $input['image_desc'][$key] : current(array_filter($input['image_desc']));
        }

        $param_article['title'] = $input['title'][0];
        $param_article['content'] = $input['content'][0];
        $param_article['image_desc'] = $input['image_desc'][0];

        if ($article_translation->validate($param_article)) {
            if ($article->save()) {
                foreach (config('app.languages') as $key=>$lang) {
                    if ($article->translation($lang)->first()) {
                        $article->translation($lang)->first()->update([
                            'title'     => isset($input['title'][$key]) ? $input['title'][$key] : current(array_filter($input['title'])),
                            'slug'     => isset($input['title'][$key]) ? str_slug($input['title'][$key].'-'.$lang, '-') : str_slug(current(array_filter($input['title'])).'-'.$lang, '-'),
                            'language'  => $lang,
                            'content'   => isset($input['content'][$key]) ? $input['content'][$key] : current(array_filter($input['content'])),
                            'image_desc'=> isset($input['image_desc'][$key]) ? $input['image_desc'][$key] : current(array_filter($input['image_desc']))
                        ]);
                    }
                }
        
                flash('Article successfully updated', 'success');
                $url     = route('admin.article.show', [$article->id]);
                $message = "Artikel dengan url ".$url." telah diperbarui";
        
                Auth::guard('admin')->user()->notify(new ArticleCompleted($article, $message));
                return redirect(route('admin.article.index'));
            }
        } else {
            return redirect(route('admin.article.create'))->withErrors($article_translation->errors())->withInput();
        }
    }

    public function publish($id)
    {
        $article = Article::find($id);

        $article->update(['published'  => 1]);

        flash('Article successfully published', 'success');

        $articlepublished = Article::with('translation')->find($article->id);
        $url     = route('admin.article.show', [$articlepublished->id]);
        $title = $articlepublished->translation('id')->first()->title;
        $message = "Article dengan judul #".$title." telah dipublish oleh superadmin. detail article url : ".$url;
        Auth::guard('admin')->user()->notify(new ArticleCompleted($article, $message));

        return redirect(route('admin.article.index'));
    }

    public function unpublish($id)
    {
        $article = Article::find($id);

        $article->update(['published'  => 0]);

        if ($article->highlight) {
            $article->update(['highlight'  => 0]);
        }

        flash('Article successfully unpublished', 'success');

        $articleunpublished = Article::with('translation')->find($article->id);
        $url     = route('admin.article.show',[$articleunpublished->id]);
        $title = $articleunpublished->translation('id')->first()->title;
        $message = "Article dengan judul #".$title." telah diunpublish oleh superadmin. detail article url : ".$url;
        Auth::guard('admin')->user()->notify(new ArticleCompleted($article, $message));

        return redirect(route('admin.article.index'));
    }

    public function hightlight($id)
    {
        $article = Article::find($id);

        if ($article->published == 1) {
            $article->update(['highlight'  => true]);
        } else {
            flash('Article is not published, please publish first', 'danger');
            return redirect(route('admin.article.index'));
        }

        flash('Article successfully highlighted', 'success');

        $url     = route('admin.article.show',$article->slug);
        $message = "An article with #".$url." has been highlighted successfully";

        Auth::guard('admin')->user()->notify(new ArticleCompleted($article, $message));

        return redirect(route('admin.article.index'));
    }

    public function unhightlight($id)
    {
        $article = Article::find($id);

        $article->update(['highlight'  => false]);

        flash('Article successfully unhighlighted', 'success');

        $url     = route('admin.article.show', $article->slug);
        $message = "An article with #".$url." highlight canceled";

        Auth::guard('admin')->user()->notify(new ArticleCompleted($article, $message));

        return redirect(route('admin.article.index'));
    }

    public function destroy($id)
    {
        $article = Article::with('translation')->find($id);
        if ($article) {
            $title = $article->translation('id')->first();
            $title = $title ? $title->title : null;
            $articleTranslation = $article->article_translations();
            if ($articleTranslation) {
                $articleTranslation->delete();
                $message = "Article dengan judul #".$title." telah dihapus";
                Auth::guard('admin')->user()->notify(new ArticleCompleted($article, $message));
                $article->delete();
            }
        }
        return redirect(route('admin.article.index'));
    }

    public function show($id)
    {
        $article = Article::find($id);
        $title = "Detail Article";

        return view('admin.article.show', compact('article', 'title', 'categories'));
    }
}
