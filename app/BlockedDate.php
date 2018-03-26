<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class BlockedDate extends Model
{
    protected $fillable = [ 'title', 'date' ];
    
    private $rules = [
                        'title' => 'required|max:50',
                        'date' => 'required|date|after:tomorrow'
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
