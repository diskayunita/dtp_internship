<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class About_translation extends Model
{
    protected $fillable = [
                            'language', 
                            'content', 
                            'about_id'
                        ];

    public function about()
    {
        return $this->belongsTo('App\About', 'about_id');
    }
}
