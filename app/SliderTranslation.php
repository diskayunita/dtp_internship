<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SliderTranslation extends Model
{ 
    protected $fillable = [
                            'slider_id', 
                            'caption', 
                            'description', 
                            'referal_link', 
                            'language'
                        ];

    public function slider()
    {
        return $this->belongsTo('App\Slider');
    }
}
