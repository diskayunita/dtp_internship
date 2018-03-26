<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Actuallymab\LaravelComment\CanComment;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;
use DB;
use Eloquent;
use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable;

    use CanComment;

    use EloquentTrait;

    protected $fillable = [
                            'name',
                            'email',
                            'password',
                            'mobile_number',
                            'address',
                            'university',
                            'nim',
                            'major',
                            'faculty',
                            'recaptcha',
                            'confirmed',
                            'avatar'
                        ];

    protected $hidden = [
                            'password', 
                            'remember_token',
                        ];
    
    public function events()
    {
        return $this->hasMany('App\Event');
    }
    
    public function routeNotificationForSlack() 
    {
        return env('SLACK_WEBHOOK_URL');
    }

    public function SocialProviders()
    {
        return $this->hasMany(SocialProvider::class);
    }

    public function getGroupDateAttribute()
    {
        return Carbon::parse($this->attributes['group_date'])->formatLocalized('%d %b %Y'); 
    }

    public static function userChart($format= "'%d %b %Y'", $year = null){
        /*$res = static::select(DB::raw('created_at as group_date'),DB::raw('count(id) as user_count'))
                        ->groupBy('group_date')
                        ->orderBy('group_date','ASC')->get();*/
        $res = static::select(
            DB::raw('count(id) as `user_count`'),
            DB::raw("DATE_FORMAT(created_at, '%m-%Y') month_year"),
            DB::raw('YEAR(created_at) year, MONTH(created_at) month')
        )
        ->groupby('year','month')
        ->get();
        return $res->unique('month_year');
    }
}