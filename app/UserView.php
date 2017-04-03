<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserView extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';
    public $timestamps = false;

    protected $fillable = ['email'];


    public function country() {
        return $this->belongsTo('App\Country');
    }

    public function firm(){
        return $this->belongsTo("App\Firm");
    }

    public function universities(){
        return $this->belongsToMany("App\University");
    }

    public function views(){
        return $this->hasMany("App\View", 'user_id');
    }
}