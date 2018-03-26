<?php

namespace App;

use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;

use Eloquent;

class Article extends Eloquent implements StaplerableInterface
{
    use EloquentTrait;

    protected $fillable = ['published', 'admin_id', 'highlight', 'category_id', 'image','total_view','total_share'];
    protected $visible = ['published', 'admin_id', 'highlight', 'category_id','total_view','total_share'];

    public function __construct(array $attributes = array()) {
        $this->hasAttachedFile('image', [
                                            'styles' => [
                                                            'zoomed' => '1200x900',
                                                            'notzoom' => '600x600',
                                                            'medium' => '300x300',
                                                            'thumb' => '100x100'
                                                        ]
                                        ]);

        parent::__construct($attributes);
    }

    public function translation($language = null)
    {
        if ($language == null) {
            $language = config('app.locale');
        }

        return $this->hasMany('App\ArticleTranslation')->where('language', '=', $language);
    }

    public function article_translations()
    {
        return $this->hasMany('App\ArticleTranslation');
    }

    public function author()
    {
        return $this->belongsTo('App\Admin', 'admin_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function scopePublished($query)
    {
        $query->where('published', 1)->orderBy('created_at', 'desc');
    }

    public function scopeHighlighted($query)
    {
        $query->where('highlight', true)->orderBy('created_at', 'desc');
    }
}
