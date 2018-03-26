<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Purpose extends Model
{
    protected $fillable = [ 'name' ];

	private $rules = ['name' => 'required|alpha|max:50',	];

    public function event()
    {
        return $this->belongsToMany('App\Event', 'event_purposes');
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

        return $this->hasMany('App\PurposeTranslation')->where('language', '=', $language);
    }

    public function purpose_translations()
    {
        return $this->hasMany('App\PurposeTranslation');
    }
}
