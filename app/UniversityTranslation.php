<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UniversityTranslation extends Model
{
    protected $fillable = [
	    'language',
		'name',
		'description',
		'category_id'
    ];

    public function university()
    {
        return $this->belongsTo('App\University');
    }
}
