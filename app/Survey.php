<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    //
    protected $fillable = ['title','global_type','description','published'];

    protected $dates = ['deleted_at'];

    public function event() {
        return $this->hasMany(Event::class);
    }

    public function questions() {
        return $this->hasMany(Question::class);
    }
    public static function published(){
        return static::where('published',true);
    }
    public function answers() {
        return $this->hasMany(Answer::class);
    }
}
