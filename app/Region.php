<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = 'regions';
    public $timestamps = false;


    public function countries() {
    	return $this->hasMany('App\Country');
    } 

    public function subRegions() {
        return $this->hasMany('App\SubRegion');
    }

}