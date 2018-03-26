<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventProduct extends Model
{
    protected $fillable = [
                            'event_id',
                            'product_id',
                            'name'
                        ];
}
