<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\PorfolioPDF as PortfolioPDF;
use App\ActionTypes as ActionType;
use App\UserView as User;
use App\IpAddress as IpAddress;
use App\Action as Action;
use App\Product as Product;
use App\View as View;

use Carbon\Carbon as Carbon;


class ImportController extends Controller
{


	public function index() {
		return $actions = Product::with('views.action.type')->limit(1)->get();;
	}

    public function PortfolioPDF() {

    	$actions = PortfolioPDF::where('processed', 0)->take(500)->get();

    	foreach ($actions as $action) {
  
    		// 1. get the action id

    		$action_type = ActionType::firstOrCreate(['url' => $action->action_type]);

    		// 2. search for a user (make a new one if doesnt exist)

    		$user = User::firstOrCreate(['email' => $action->email]);

    		// 3. ip lookup for database (make a new one if doesnt exist)

    		$ip_address = IpAddress::firstOrCreate(['ip_address' => $action->ip]);

    		// 4. Save the action


    		$new_action = new Action;

    		$new_action->type_id = $action_type->id;
    		$new_action->user_id = $user->id;
    		$new_action->ip_address = $ip_address->ip_address;
    		$new_action->performed_at = Carbon::createFromFormat('n/j/y G:i:s', $action->viewed_at);

    		$new_action->save();

    		// 5. process the products

    		$tickers = explode('|', $action->product_tickers);
    		//$ticker_weights = explode('|', $action->product_weights);

    		foreach ($tickers as $key => $ticker) {
    			$product = Product::firstOrCreate(['ticker' => $ticker]);
    			$view = new View;
    			$view->product_id = $product->id;
    			$view->source_id = 1;
    			$view->action_id = $new_action->id;
    			$view->user_id = $user->id;
    			$view->viewed_at = Carbon::createFromFormat('n/j/y G:i:s', $action->viewed_at);
    			$view->save();
    		}

    		$action->processed = 1;
    		$action->save();


    		// 7. create a new view



    	}

    	return PortfolioPDF::where('processed', 0)->count();

    }
}
