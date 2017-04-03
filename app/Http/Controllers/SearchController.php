<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product as Product;
use App\Issuer as Issuer;
use App\Firm as Firm;

class SearchController extends Controller
{
    public function show(Request $request) {

    	if ($request->has('q')) {

    		//search products

    		$products = Product::search($request->q)->get();

    		$issuers = Issuer::search($request->q)->get();

    		$firms = Firm::search($request->q)->get();

    		return view('search', [
    			'request' => $request,
    			'products'	=> $products,
    			'issuers' => $issuers,
    			'firms'	=> $firms
    			]);
    	} else {
    		return "search_bar";
    	}
    	
    }
}
