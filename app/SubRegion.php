<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubRegion extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = 'sub_regions';
    public $timestamps = false;


    public function region() {
        return $this->belongsTo('App\Region');
    } 

    public function countries() {
        return $this->hasMany('App\Country');
    }

}