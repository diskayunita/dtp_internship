<?php

namespace App;

use App\Notifications\AdminResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class Admin extends Authenticatable
{

    use Notifiable;
    use EntrustUserTrait;

    public function articles()
    {
        return $this->hasMany('App\Article', 'admin_id');
    }
    public function event_responses()
    {
        return $this->hasMany('App\EventResponse','admin_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                            'name', 
                            'email', 
                            'password',
                        ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
                            'password', 
                            'remember_token',
                        ];

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPassword($token));
    }

    public function routeNotificationForSlack() {
        return env('SLACK_WEBHOOK_URL', 'https://hooks.slack.com/services/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');
    }
    
    public function galleries()
    {
        return $this->hasMany('App\Gallery', 'admin_id');
    }

    public function sliders()
    {
        return $this->hasMany('App\Slider');
    }

    public function reply()
    {
        return $this->hasMany('App\ContactReply');
    }
}
