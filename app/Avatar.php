<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;
use Eloquent;

class Avatar extends Eloquent implements StaplerableInterface
{
    //
    use EloquentTrait;

    protected $table = 'users';

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

    public function __construct(array $attributes = array()) {
        $this->hasAttachedFile('avatar', [
                                            'styles' => [
                                                'medium' => '300x300',
                                                'thumb' => '100x100',
                                                'small' => '73x73'
                                            ]
                                        ]);

        parent::__construct($attributes);
    }
}
