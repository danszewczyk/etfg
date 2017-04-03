<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActionTypes extends Model
{
    protected $table = "action_types";
    public $timestamps = false;

    protected $fillable = [
        'url', 'name',
    ];


    public function actions() {
    	return $this->hasMany('App\Action', 'type_id');
    }

    public function views() {
    	return $this->hasManyThrough('App\View', 'App\Action', 'type_id');
    }

}
