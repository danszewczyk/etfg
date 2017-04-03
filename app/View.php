<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'views';

    public $timestamps = false;

    public function user() {
        return $this->belongsTo('App\UserView');
    }

    public function source() {
        return $this->belongsTo('App\ViewSource');
    }

    public function product() {
        return $this->belongsTo('App\Product');
    }

    public function action() {
        return $this->belongsTo('App\Action');
    }


}