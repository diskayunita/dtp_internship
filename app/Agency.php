<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Agency extends Model
{
    protected $fillable = [
                            'name', 
                            'description'
                        ];

    private $rules = [
                        'name' => 'required|alpha|max:50',
                        'description' => 'required'
                    ];

    private $errors;

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

    public function translation($language = null)
    {
        if ($language == null) {
            $language = config('app.fallback_locale');
        }

        return $this->hasMany('App\AgencyTranslation')->where('language', '=', $language);
    }

    public function agency_translations()
    {
        return $this->hasMany('App\AgencyTranslation');
    }
}
