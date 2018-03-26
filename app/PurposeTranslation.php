<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class PurposeTranslation extends Model
{
    protected $fillable = ['purpose_id', 'name', 'language'];

    public function purpose()
    {
        return $this->belongsTo('App\Purpose');
    }
}