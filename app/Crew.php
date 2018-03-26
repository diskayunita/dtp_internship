<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Codesleeve\Stapler\ORM\EloquentTrait;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Eloquent;

class Crew extends Eloquent implements StaplerableInterface
{
    //
    use EloquentTrait;

    protected $table = 'crew';

    protected $fillable = [
                            'name', 
                            'position', 
                            'facebook', 
                            'twitter', 
                            'avatar', 
                            'gender',
                        ];

    public function __construct(array $attributes = array())
    {
        $this->hasAttachedFile('avatar', [
                                            'styles' => [
                                                            'medium' => '450x450',
                                                            'small' => '250x250',
                                                            'thumb' => '100x100',
                                                        ]
                                        ]);

        parent::__construct($attributes);
    }

}
