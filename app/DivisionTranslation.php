<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DivisionTranslation extends Model
{
    protected $fillable = [
                            'language',
                            'name',
                            'description',
                            'division_id'
                        ];

    public function category()
    {
        return $this->belongsTo('App\Division');
    }
}
