<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';
    public $timestamps = false;

    public function tickers(){
    	return $this->hasMany('App\Ticker');
    }

  

    
}