<?php

namespace App;

use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;

class About extends Model
{
    protected $fillable = [
                            'published', 
                            'admin_id',
                            'video'
                        ];
    protected $visible = [
                            'published', 
                            'admin_id',
                            'video'
                        ];

    public function translation($language = null)
    {
        if ($language == null) {
            $language = config('app.locale');
        }

        return $this->hasMany('App\About_translation')->where('language', '=', $language);
    }

    public function about_translations()
    {
        return $this->hasMany('App\About_translation');
    }
}
