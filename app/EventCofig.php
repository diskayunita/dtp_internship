<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventCofig extends Model
{
    protected $fillable = [
                            'minparticipant',
                            'maxparticipant',
                            'blockeddate',
                            'minimumdate'
                        ];
}
