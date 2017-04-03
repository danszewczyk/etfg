<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductFocus extends Model 
{
	
	protected $table = 'product_focuses';

	public function category() {
	   return $this->belongsTo('App\ProductCategory', 'product_category_id');
	}

	public function products() {
		return $this->hasMany('App\Product', 'focus_id');
	}

	public function views() {
	    return $this->hasManyThrough('App\View', 'App\Product', 'focus_id');
	}


}