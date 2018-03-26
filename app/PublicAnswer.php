<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PublicAnswer extends Model
{
    //
    protected $fillable = [
                            'question_id', 
                            'survey_id',
                            'answer', 
                            'ip_user'
                        ];

    public function survey() {
        return $this->belongsTo(Survey::class);
    }

    public function question() {
        return $this->belongsTo(Question::class);
    }
}
