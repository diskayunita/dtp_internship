<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;

use Eloquent;

class Gallery extends Eloquent implements StaplerableInterface
{
    //

    use EloquentTrait;
    
    protected $fillable = ['admin_id', 'image', 'published','category_id'];

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
            $language = config('app.fallback_locale');
        }
        
        return $this->hasMany('App\GalleryTranslation')->where('language', '=', $language);
    }

    public function gallery_translations()
    {
        return $this->hasMany('App\GalleryTranslation');
    }

    public function author(){
        return $this->belongsTo('App\Admin', 'admin_id');
    }

    public function scopePublished($query)
    {
        $query->where('published', 1)->orderBy('created_at', 'desc');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

}