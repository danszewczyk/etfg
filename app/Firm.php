<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Laravel\Scout\Searchable;

class Firm extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    use Searchable;

    protected $table = 'firms';
    public $timestamps = false;

    
    public function users(){
    	return $this->hasMany('App\UserView');
    }

    public function views() {
        return $this->hasManyThrough('App\View', 'App\UserView', 'firm_id', 'user_id');
    }

    public function asset_class() {
        return $this->hasManyThrough('App\AssetClass', 'App\Product');
    }

}