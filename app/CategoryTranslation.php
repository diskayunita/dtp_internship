<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
    protected $fillable = [
	    'language',
		'name',
		'description',
		'category_id'
    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
