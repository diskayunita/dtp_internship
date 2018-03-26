<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';
    
    public $timetamps = true;

    protected $fillable = [
                            'id',
                            'user_id',
                            'name',
                            'email',
                            'subject',
                            'message',
                            'contact_type',
                            'priority',
                            'read'
                        ];

    public function reply()
    {
        return $this->hasMany('App\ContactReply', 'user_id');
    }
}
