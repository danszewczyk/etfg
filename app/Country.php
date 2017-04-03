<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = 'countries';
    public $timestamps = false;


    public function region() {
    	return $this->belongsTo('App\Region');
    } 

    public function subRegion() {
        return $this->belongsTo('App\SubRegion');
    }

    public function views() {
        return $this->hasManyThrough('App\View', 'App\UserView', 'country_id', 'user_id');
    }
    
    public function users() {
        return $this->hasMany('App\UserView');
    }


}