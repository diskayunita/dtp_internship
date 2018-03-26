<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';
    
    public $timetamps = true;

    protected $fillable = [
                            'id',
                            'user_id',
                            'name',
                            'subject',
                            'message',
                            'contact_type',
                            'priority',
                            'read',

                        ];

    public function reply()
    {
        return $this->hasMany('App\MessageReply', 'user_id');
    }
}
