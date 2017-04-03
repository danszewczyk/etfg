<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Laravel\Scout\Searchable;

class Issuer extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    use Searchable;
    
    protected $table = 'issuers';

    public $timestamps = false;

    public function products(){
    	return $this->hasMany('App\Product');
    }

    public function views() {
        return $this->hasManyThrough('App\View', 'App\Product');
    }

    

}