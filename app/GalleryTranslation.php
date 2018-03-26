<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GalleryTranslation extends Model
{
    //
    protected $fillable = [
                            'gallery_id',
                            'caption',
                            'description',
                            'language',
                            'image_url_zoomed',
                            'image_url_notzoom',
                            'image_url_medium',
                            'image_url_thumb'
                        ];

    public function gallery()
    {
        return $this->belongsTo('App\Gallery');
    }

    public function scopeSearch($query,$search)
    {
        $query->where('caption','like',"%".$search."%")
                ->orWhere('description','like',"%".$search."%")
                ->orderBy('created_at', 'desc');
    }
}
