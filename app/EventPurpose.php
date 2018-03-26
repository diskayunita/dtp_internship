<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventPurpose extends Model
{
    protected $fillable = [
                            'event_id',
                            'purpose_id'
                        ];
}
