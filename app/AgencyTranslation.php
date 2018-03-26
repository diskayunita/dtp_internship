<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgencyTranslation extends Model
{
    protected $fillable = [
	    'language',
		'name',
		'description',
		'category_id'
    ];

    public function agency()
    {
        return $this->belongsTo('App\Agency');
    }
}
