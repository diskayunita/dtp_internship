<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;

use Eloquent;

class Slider extends Eloquent implements StaplerableInterface 
{
    use EloquentTrait;
    //
    protected $fillable = ['admin_id', 'published', 'image', 'display_page'];

    public function __construct(array $attributes = array()) {
        $this->hasAttachedFile('image', [
                                            'styles' => [
                                                            'slider' => 'x450', // set width auto based on fixed height
                                                            'medium' => '300x300',
                                                            'thumb' => '100x100'
                                                        ]
                                        ]);

        parent::__construct($attributes);
    }

    public function translation($language = null)
    {
        if ($language == null) {
            $language = config('app.fallback_locale');
        }
        
        return $this->hasMany('App\SliderTranslation')->where('language', '=', $language);
    }

    public function slider_translations()
    {
        return $this->hasMany('App\SliderTranslation');
    }

    public function author()
    {
        return $this->belongsTo('App\Admin', 'admin_id');
    }

    public function scopePublished($query)
    {
        $query->where('published', 1)->orderBy('created_at', 'desc');
    }
}
