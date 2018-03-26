<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Codesleeve\Stapler\ORM\EloquentTrait;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Eloquent;

class Division extends Eloquent implements StaplerableInterface
{
    use EloquentTrait;

    private $errors;

    public function __construct(array $attributes = array())
    {
        $this->hasAttachedFile('avatar', [
                                            'styles' => [
                                                            'medium' => '450x450',
                                                            'small' => '250x250',
                                                            'thumb' => '100x100',
                                                        ]
                                        ]);

        parent::__construct($attributes);
    }

    public function translation($language = null)
    {
        if ($language == null) {
            $language = config('app.fallback_locale');
        }

        return $this->hasMany('App\DivisionTranslation')->where('language', '=', $language);
    }

    public function category_translations()
    {
        return $this->hasMany('App\DivisionTranslation');
    }
}
