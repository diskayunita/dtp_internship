<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessageReply extends Model
{
    protected $table = 'message_replies';

    protected $fillable = [
                            'sender_id', 
                            'user_id', 
                            'message'
                        ];

    public function sender()
    {
        return $this->belongsTo('App\Admin', 'sender_id');
    }

    public function recipient()
    {
        return $this->belongsTo('App\Message', 'user_id');
    }
}
