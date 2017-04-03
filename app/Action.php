<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    protected $table = "actions";
    public $timestamps = false;

    protected $fillable = [
        'type_id', 'user_id', 'ip_address', "performed_at",
    ];

    public function user() {
    	return $this->belongsTo('App\UserView');
    }

    public function type() {
    	return $this->belongsTo('App\ActionTypes');
    }

    public function views() {
    	return $this->hasMany('App\View');
    }


}
