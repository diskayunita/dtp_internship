<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class ParticipantLimit extends Model
{
    //
    protected $fillable = [
        'minimal',
        'maximal',
        'description'
    ];

    private $rules = [
        'minimal' => 'required_with:maximal|integer|min:1',
        'maximal' => 'required_with:minimal|integer|greater_than_field:minimal',
        'description' => 'nullable'
    ];

    private $errors;

    public function validate($data)
    {
        $valid = Validator::make($data, $this->rules);

        if ($valid->fails()) {
            $this->errors = $valid->errors();
            return false;
        }

        return true;
    }

    public function errors()
    {
        return $this->errors;
    }
}