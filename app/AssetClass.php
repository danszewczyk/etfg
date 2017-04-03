<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssetClass extends Model 
{

	protected $table = 'asset_classes';
	public $timestamps = false;

	public function products() {
		return $this->hasMany('App\Product');
	}

	public function categories() {
		return $this->hasMany('App\ProductCategory');
	}

	 /**
     * Get all of the view for the asset_class.
     */
    public function views()
    {
        return $this->hasManyThrough('App\View', 'App\Product');
    }

}