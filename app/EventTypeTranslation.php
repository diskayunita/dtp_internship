<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventTypeTranslation extends Model
{
    protected $fillable = [
                            'language',
                            'name',
                            'description',
                            'category_id'
                        ];

    public function event_types()
    {
        return $this->belongsTo('App\EventType');
    }
}
