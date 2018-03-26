<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    protected $casts = [
                        'option_name' => 'array',
                    ];

    protected $fillable = ['title', 'question_type', 'option_name'];

    public function survey() {
        return $this->belongsTo(Survey::class);
    }

    public function answers() {
        return $this->hasMany(Answer::class);
    }

    public function public_answers() {
        return $this->hasMany(PublicAnswer::class);
    }
}
