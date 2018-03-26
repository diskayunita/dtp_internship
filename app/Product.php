<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name'];

    public function event()
    {
        return $this->belongsToMany('App\Event', 'event_products');
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

    public function translation($language = null)
    {
        if ($language == null) {
            $language = config('app.fallback_locale');
        }

        return $this->hasMany('App\ProductTranslation')->where('language', '=', $language);
    }

    public function product_translations()
    {
        return $this->hasMany('App\ProductTranslation');
    }
}
