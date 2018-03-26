<?php

namespace App;


use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;

use Eloquent;

class Showcase extends Eloquent implements StaplerableInterface
{
    use EloquentTrait;

    protected $fillable = [
                            'published',
                            'content',
                            'admin_id',
                            'image'
                        ];

    protected $visible = [
                            'published',
                            'content',
                            'admin_id',
                            'image'
                        ];

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

        return $this->hasMany('App\ShowcaseTranslation')->where('language', '=', $language);
    }

    public function showcase_translation()
    {
        return $this->hasMany('App\ShowcaseTranslation');
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
