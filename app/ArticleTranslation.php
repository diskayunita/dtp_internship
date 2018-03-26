<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Actuallymab\LaravelComment\Commentable;
use Illuminate\Support\Facades\Validator;

class ArticleTranslation extends Model
{
    use Sluggable;

    use Commentable;

    protected $fillable = [
                            'language',
                            'title',
                            'content',
                            'article_id',
                            'slug',
                            'image_desc',
                            'image_url_zoomed',
                            'image_url_notzoom',
                            'image_url_medium',
                            'image_url_thumb',
                        ];

    protected $mustBeApproved = true;

    protected $canBeRated = true;

    private $rules = [
                        'title' => 'required|min:5',
                        'content' => 'required|min:50',
                        'image_desc' => 'required|min:10'
                    ];

    private $errors;

    public function article()
    {
        return $this->belongsTo('App\Article', 'article_id');
    }

    /**
    * Return the sluggable configuration array for this model.
    *
    * @return array
    */
    public function sluggable()
    {
        return [ 
                'slug' => [
                            'source' => 'title'
                        ]
                ];
    }

    public function scopeSearch($query,$search)
    {
        $query->where('title','like',"%".$search."%")
                ->orWhere('content','like',"%".$search."%")
                ->orWhere('slug','like',"%".$search."%")
                ->orWhere('image_desc','like',"%".$search."%")
                ->orderBy('created_at', 'desc');
    }

    public function validate($data)
    {
        $valid = Validator::make($data, $this->rules);

        if ($valid->fails()) {
            $this->errors = $valid->errors();
            return false;
        }

        return true;
    }

    public function errors()
    {
        return $this->errors;
    }
}
