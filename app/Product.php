<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Laravel\Scout\Searchable;

class Product extends Model
{

    use Searchable;

    protected $table = 'products';

     protected $fillable = [
        'ticker',
    ];

    public function toSearchableArray()
    {
        $array = $this->toArray();

        $array['views'] = $this->views->count();

        return $array;
    }
    

   

    public function type() {
        return $this->belongsTo('App\ProductType');
    }

    public function issuer() {
        return $this->belongsTo('App\Issuer');
    }

    public function assetClass() {
        return $this->belongsTo('App\AssetClass');
    }

    public function category() {
        return $this->belongsTo('App\ProductCategory');
    }

    public function focus() {
        return $this->belongsTo('App\ProductFocus');
    }

    public function views() {
        return $this->hasMany('App\View');
    }

    public function users() {
        return $this->belongsToMany('App\UserView', 'views', 'product_id', 'user_id' );
    }

    
}