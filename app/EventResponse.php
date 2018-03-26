<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventResponse extends Model
{
    protected $fillable = [
                            'event_id',
                            'admin_id',
                            'response_type',
                            'message',
                            'read',
                            'date',
                            'time',
                            'location'
                        ];

    public function event()
    {
        return $this->belongsTo('App\Event');
    }
      public function staff()
    {
        return $this->belongsTo('App\Admin','admin_id');
    }
}
