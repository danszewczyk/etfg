<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_types';

    public function products() {
        return $this->hasMany('App\Product', 'type_id');
    }

    public function views() {
	    return $this->hasManyThrough('App\View', 'App\Product', 'type_id');
	}


}