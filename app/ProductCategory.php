<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model 
{

	protected $table = 'product_categories';

	public function assetClass() {
		return $this->belongsTo('App\AssetClass');
	}

	public function focuses() {
		return $this->hasMany('App\ProductFocus'); 
	}

	public function products() {
		return $this->hasMany('App\Product', 'category_id'); 
	}

	public function views() {
	    return $this->hasManyThrough('App\View', 'App\Product', 'category_id');
	}

}