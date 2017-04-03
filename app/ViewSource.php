<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ViewSource extends Model {

	protected $table = 'view_sources';

	public function views() {
		return $this->hasMany('App\View', 'source_id');
	}
	
}