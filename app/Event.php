<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;

class Event extends Model implements StaplerableInterface
{

    use EloquentTrait;

    protected $fillable = [
                            'reference_number',
                            'user_id',
                            'username',
                            'contact',
                            'email',
                            'university',
                            'faculty',
                            'title',
                            'type',
                            'credits',
                            'description',
                            'start_date',
                            'end_date',
                            'approval',
                            'is_surveyed',
                            'is_read',
                            'attachment',
                            'pakta'
                        ];

    public function __construct(array $attributes = array()) {
        $this->hasAttachedFile('attachment');
        $this->hasAttachedFile('pakta');

        parent::__construct($attributes);
    }

    protected $appends = array('count');

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function responses()
    {
        return $this->hasMany('App\EventResponse');
    }

    public function purpose()
    {
        return $this->belongsToMany('App\Purpose', 'event_purposes');
    }

    public function getPurposeIds()
    {
        return $this->purpose->pluck('id')->toArray();
    }

    public function product()
    {
        return $this->belongsToMany('App\Product', 'event_products');
    }

    public function getProductIds()
    {
        return $this->product->pluck('id')->toArray();
    }

    public function scopeEventCharts($query)
    {
        $data = $query->select('approval')->groupBy('approval')->get();
        return $data;
    }

    public function survey()
    {
        return $this->belongsTo('App\Survey');
    }

}
